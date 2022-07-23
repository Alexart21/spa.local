<?php

namespace app\controllers;

use yii\base\BaseObject;
use yii\helpers\FileHelper;
use yii\web\Controller;
use app\models\test\TestModel;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;
use Yii;

class TestController extends Controller
{
    public $layout = 'test';

    public function actionIndex()
    {
        $this->enableCsrfValidation = false;
        $model = new TestModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        }
        return $this->render('index', compact('model'));
    }

    public function actionNew()
    {
        $model = new TestModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        }
        return $this->render('new', compact('model'));
    }

    public function actionAlert()
    {
        return $this->render('alert');
    }

    public function actionFaker(){
        return $this->render('faker');
    }

    public function actionTest()
    {
        return $this->render('test');
    }
    

}
