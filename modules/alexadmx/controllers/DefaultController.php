<?php

namespace app\modules\alexadmx\controllers;

use app\models\User;
use Yii;
use app\modules\alexadmx\models\Content;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `alexadmx` module
 */
class DefaultController extends AppAlexadmxController
{

//    $this->layout = 'alexadmx'; // в конфиге прописал

    public function actionIndex()
    {
        return $this->render('index');
    }

    /* Для всех страниц заголовок Last Modified текущее время c небольшим разбросом */
    public function actionLast()
    {
        if (Yii::$app->request->isAjax) {
            // очищаем кэш
            Yii::$app->cache->flush();

            // таблица Content
            // start transaction
            $flag = true;
//            $transaction = Yii::$app->db->beginTransaction();
            $lastContent = Content::find()->where(true)->all();
//            debug($lastContent);die;
            foreach ($lastContent as $last) {
                $time = time() - rand(60, 300); // разброс от 1 до 5 минут
                $last->last_mod = $time;
                $res = $last->save();
                $flag = ($flag && $res) ? true : false;
                if (!$flag){
                    break;
                }
            }

            /*if ($flag){
//                $transaction->commit();
                $result = true;
            }else{
//                $transaction->rollBack();
                $result = false;
            }*/

            $result = $flag ? true : false;
            $flag = true;
            $header = '<h3>LastModified</h3>';
            return $this->renderPartial('modal', compact('result', 'flag', 'header'));

//            return $this->renderFile('@app/modules/alexadmx/views/alert.php', compact('result'));
        }
    }

    /* Очистка кэша */
    public function actionCache()
    {
        if (Yii::$app->request->isAjax) {
//            sleep(3);
            $result = Yii::$app->cache->flush() ? true : false;
            $flag = true;
            $header = '<h3>Очистка кэша</h3>';
            return $this->renderPartial('modal', compact('result', 'flag', 'header'));

//            return $this->renderFile('@app/modules/alexadmx/views/alert.php', compact('result'));
        }
    }

    /* Генерация файла Sitemap.xml */
    public function actionSitemap()
    {
        $siteRoot = __DIR__ . '/../../../web/';
        $contentPriority = 1;
        $XML = '';

        /* Таблица Content */

        $sql = 'SELECT `page`, `last_mod` FROM content WHERE 1';
        $content = Content::findBySql($sql)->asArray()->all();
        foreach ($content as $data) {
            if ($data['page'] != 'index') {
                $data['page'] = '/' . $data['page'];
            } else {
                $data['page'] = '';
            }

            $date = date('Y-m-d', $data['last_mod']);
//            $XML .= "\r\n<url>\r\n\t<loc>https://" . Yii::$app->params['siteUrl'] . $data['page'] . "</loc>\r\n\t<changefreq>weekly</changefreq>\r\n\t<lastmod>" . $date . "</lastmod>\r\n\t<priority>" . $contentPriority . "</priority>\r\n</url>";
            $XML .= "\r\n<url>\r\n\t<loc>https://" . 'alexart.s-solo.ru' . $data['page'] . "</loc>\r\n\t<changefreq>weekly</changefreq>\r\n\t<lastmod>" . $date . "</lastmod>\r\n\t<priority>" . $contentPriority . "</priority>\r\n</url>";
        }


        $resXML = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'
            . $XML . "\n</urlset>";
        $fp = fopen($siteRoot . 'sitemap.xml', 'w+') or die('не могу открыть файл sitemap.xml !');

        $result = fwrite($fp, $resXML) ? true : false;
        $flag = true;
        $header = '<h3>Sitemap.xml</h3>';
        return $this->renderPartial('modal', compact('result', 'flag', 'header'));
//        return $this->renderFile('@app/modules/alexadmx/views/alert.php', compact('result'));
    }

    /* Очистка временных и.т.п. папок */
    public function actionClear()
    {
        if (Yii::$app->request->isAjax) {
            $dirArr = require_once __DIR__ . '/../views/inc/dirArr.php'; // здесь массив с очищаемыми папками
            $fileCount = $dirCount = $errCount = 0; // счетчики
            $clearSize = 0; // сколько удалено(освобождено байт)
            foreach ($dirArr as $dirPath) {
                $dirPath = __DIR__ . '/../../../' . $dirPath;
                $fileArr =  FileHelper::findFiles($dirPath);
                $dirList = FileHelper::findDirectories($dirPath);
                // удаление файлов
                foreach ($fileArr as $filePath) {
                   if(isset($filePath)) {
                       $size = @filesize($filePath);
                       $fRes = @unlink($filePath);
                       $clearSize += $size;
                   }
                        if ($fRes) {
                            $fileCount++;
                        } else {
                            $errCount++;
                        }
                }
                // удаление директорий (если есть)
                foreach ($dirList as $dir){
                   if(isset($dir)){
                     $dRes = @rmdir($dir);
                   }

                    if ($dRes) {
                        $dirCount++;
                    } else {
                        $errCount++;
                    }
                }
            }
            $header = '<h3>Очистка папок</h3>';
            $flag = false;
            return $this->renderPartial('modal', compact('flag', 'fileCount', 'dirCount', 'errCount', 'header', 'clearSize', 'dirArr'));
        }
    }

    public function actionPhpinfo()
    {
        return $this->renderFile( __DIR__ .'/../views/default/phpinfo.php');
    }

    /* Очиска таблицы чата */
    public function actionChatClear()
    {
        if (Yii::$app->request->isAjax) {
            $session = Yii::$app->session;
            $session->remove('user_name');
            $session->remove('user_color');

            $header = '<h3>Очистка чата</h3>';
            $res = Yii::$app->db->createCommand()->truncateTable('chat')->execute();
            $flag = true;
            $result = $res == 0 ? true : false;
            return $this->renderPartial('modal', compact('result', 'flag', 'header'));
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /* Показ аватара в модалке */
    public function actionAvatar($user)
    {
        if (Yii::$app->request->isAjax) {
            if(!Yii::$app->user->isGuest){
                $model = User::findOne(['username' => $user]);
                return $this->renderPartial('avatar', compact('model'));
            }

        }
    }
}
