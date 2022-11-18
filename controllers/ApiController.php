<?php
namespace app\controllers;

use app\models\Country;
use yii\web\Controller;
use Yii;

class ApiController extends Controller
{

    public function actionInf($offset = 0, $step = 10)
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $total = Country::find()->count();
        if($offset > $total){
            $response->data = [
                'success' => false,
            ];
        }

        sleep(1);

        $this->enableCsrfValidation = false;
        $country = Country::find()
            ->orderBy('name')
            ->offset($offset)
            ->limit($step)
            ->all();
        if ($country) {
            $response->data = [
                'success' => true,
                'data' => $country,
                'total' => $total,
            ];
        } else {
            $response->data = ['success' => false];
        }
        return $response->data;
    }

}