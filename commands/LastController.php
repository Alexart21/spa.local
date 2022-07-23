<?php
namespace app\commands;

use app\modules\alexadmx\models\Content;
use yii\console\Controller;
use Yii;

class LastController extends Controller
{
    
    public function actionIndex()
    {
        /* unix timestanp для заголовка LastModified В текущее время */
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

        $result = $flag ? 'OK!' : 'Error!';
        echo 'LastModified: ' . $result . "\n";

        /* Перегенерация файла Sitemap.xml */
        $siteRoot = __DIR__ . '/../web/' ;
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
            $XML .= "\r\n<url>\r\n\t<loc>https://www." . Yii::$app->params['siteUrl'] . $data['page'] . "</loc>\r\n\t<changefreq>weekly</changefreq>\r\n\t<lastmod>" . $date . "</lastmod>\r\n\t<priority>" . $contentPriority . "</priority>\r\n</url>";
        }


        $resXML = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'
            . $XML . "\n</urlset>";
        $fp = fopen($siteRoot . 'sitemap.xml', 'w+') or die('не могу открыть файл sitemap.xml !');

        $result = fwrite($fp, $resXML) ? 'Ok!' : 'Error!';
        echo 'Sitemap.xml: ' . $result . "\n";
    }
    
}