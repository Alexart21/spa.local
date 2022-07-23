<?php

namespace app\modules\alexadmx\controllers;

use app\modules\alexadmx\models\Msg;
use Yii;
use app\models\Post;
use app\modules\alexadmx\models\PostSearch;
use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends AppAlexadmxController
{
    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDel_all() // Очистка всей табли `post`
    { // Удаление всех писем
//        $res = Yii::$app->db->createCommand()->truncateTable('post')->execute();
        $res = Post::deleteAll();
        if ($res !== 0) {
            return $this->redirect('/alexadmx/post');
        }
    }

    /* Помечаем все письма как прочитанные */
    public function actionPostlabel()
    {
            Msg::setPostAllRead();
            unset($_SESSION['newPostCount']);
            return $this->redirect('/alexadmx/post');
    }

    /* Помечаем запись как прочитанную */
    // Обрати внимание результат возвращается без view
    // Показываем кастомным алертом успех/ошибка
    public function actionRead($id)
    {
        if (Yii::$app->request->isAjax) {
            $id = (int)$id;
            $model = $this->findModel($id);
            $model->is_read = 1;
            $res = $model->save();

            $res = $res ? '<h3 style="color: green">Успешно</h3><script>setTimeout(\'alert_close()\', 2000)</script>' : '<h3 style="color: red">Сбой!</h3>';
            return $res;
        }
    }
}
