<?php

namespace app\controllers;

use app\models\Auth;
use app\models\IndexForm;
use app\models\Content;
use app\models\CallForm;
use app\models\Callback;
use app\models\Post;
use app\models\User;
use app\models\City;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class SiteController extends Controller
{
  /**
   * @inheritdoc
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'auth' => [
        'class' => 'yii\authclient\AuthAction',
        'successCallback' => [$this, 'onAuthSuccess'],
      ],
    ];
  }

  /*public function behaviors()
  {
      return [
          'rateLimiter' => [
              'class' => \yii\filters\RateLimiter::class,
              'enableRateLimitHeaders' => true,
          ],
      ];
  }*/

  public function onAuthSuccess($client)
  {
    $attributes = $client->getUserAttributes();
//        var_dump($attributes);die;
    /* @var $auth Auth */
    $auth = Auth::find()->where([
      'source' => $client->getId(),
      'source_id' => $attributes['id'],
    ])->one();
    if (Yii::$app->user->isGuest) {
      if ($auth) { // авторизация
        $user = $auth->user;
        Yii::$app->user->login($user, Yii::$app->params['rememberMeSec']); // логиним и запоминаем на сколькото там дней
      } else { // регистрация
        if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
//                    var_dump($client->getTitle());
          echo("<h4>Пользователь с такой электронной почтой как в {$client->getTitle()} уже существует</h4>");
          $usr = User::find()->where(['email' => $attributes['email']])->one();
          $x = Auth::find()->where(['user_id' => $usr->id])->one();
          if ($x) {
            echo "<h4>Вы уже использовали email адрес {$attributes['email']} когда заходили через {$x->source}</h4>";
            echo '<h1>Вы можете:</h1>';
            echo "<h4>1. Снова войти через <a style='font-size: 150%' href=\"/site/auth?authclient={$x->source}\">{$x->source}</a> (рекомендуется)</h4>";
            echo "<h4>2. Вернуться назад и войти через другой внешний сервис авторизации где у вас email отличный от {$attributes['email']}</h4>";
            echo '<h4>3. Вернуться назад и войти или зарегистрироваться обычным способом</h4>';
          }
          die;
        } else {
//                    var_dump($attributes);die;
          $authClient = $client->getTitle();
//                    var_dump($authClient);die;
          $password = Yii::$app->security->generateRandomString(6); // просто затык
          if ($authClient == 'Google' || $authClient == 'GitHub') {
            $user = new User([
              'username' => $attributes['name'],
              'email' => $attributes['email'],
              'password_hash' => $password,
              'status' => 10,
            ]);
          } elseif ($authClient == 'Yandex') {
            $user = new User([
              'username' => $attributes['login'], // у яндекса login видишь ли
              'email' => $attributes['login'] . '@yandex.ru', // вот такая дичь
              'password_hash' => $password,
              'status' => 10,
            ]);
          } elseif ($authClient == 'VKontakte') {
            if (!$attributes['email']) {
              die('<h4 style="color: red">Вы не разрешили показывать Ваш email! Подтвердите эту возможность.</h4>');
            }
            $user = new User([
              'username' => trim($attributes['first_name'] . ' ' . $attributes['last_name']),
              'email' => $attributes['email'],
              'password_hash' => $password,
              'status' => 10,
            ]);
          } elseif ($authClient == 'MailRu') {
            $user = new User([
              'username' => $attributes['nick'],
              'email' => $attributes['email'],
              'password_hash' => $password,
              'status' => 10,
            ]);
          }
          $user->generateAuthKey();
          $user->last_login = time();
          $transaction = $user->getDb()->beginTransaction();
          if ($user->save()) {
            $auth = new Auth([
              'user_id' => $user->id,
              'source' => $client->getId(),
              'source_id' => (string)$attributes['id'],
            ]);
            if ($auth->save()) {
              $transaction->commit();
              Yii::$app->user->login($user, Yii::$app->params['rememberMeSec']); // логиним и запоминаем на сколькото там дней
            } else {
              print_r($auth->getErrors());
            }
          } else {
            print_r($user->getErrors());
          }
        }
      }
    } else { // Пользователь уже зарегистрирован
      if (!$auth) { // добавляем внешний сервис аутентификации
        $auth = new Auth([
          'user_id' => Yii::$app->user->id,
          'source' => $client->getId(),
          'source_id' => $attributes['id'],
        ]);
        $auth->save();
      }
    }

  }

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionIndex()
  {
    $indexForm = new IndexForm();
    $request = Yii::$app->request;

    /* Отправка сообщения и запись в БД */
    if ($indexForm->load($request->post())) {
      $response = Yii::$app->response;
      $response->format = \yii\web\Response::FORMAT_JSON;
      if ($indexForm->validate()) {

        $success = $indexForm->mailSend(); // отправка email
        $msg = new Post();
        $res = $msg->dbSave($indexForm); // звпись в БД

        if($success && $res){
          $response->data = ['status' => true];
          return json_encode($response->data);
        }else{
          $response->data = ['status' => false];
          return json_encode($response->data);
        }
      } else { // reCapctha3 не пропустила или иная причина валидации
       // throw new BadRequestHttpException(serialize($indexForm->errors));
        $errors = $indexForm->errors;
        // $msg = json_encode($errors);
        $response->data = ['status' => false, 'msg' => $errors];
        return json_encode($response->data);
      }
    }
    return $this->render('index');
  }


  /* Виджет обратного звонка */
    public function actionCall()
    {
        // die('here');
        $request = Yii::$app->request;
        if ($request->isPost) {
            $formModel = new CallForm();

            if ($formModel->load($request->post())) {
              $response = Yii::$app->response;
              $response->format = \yii\web\Response::FORMAT_JSON; 
              if($formModel->validate()){
                // Отправка email и запись в БД
                $success = $formModel->callSend();
                $call = new Callback();
                $res = $call->dbSend($formModel);
                if($success && $res){
                  $response->data = ['status' => true];
                  return json_encode($response->data);
                }else{
                  $response->data = ['status' => false];
                  return json_encode($response->data);
                }
              } else { // reCapctha3 не пропустила или иная причина
                $errors = $formModel->errors;
                $response->data = ['status' => false, 'msg' => $errors];
                return json_encode($response->data);
            }
          } 
        }
    }

    public function actionRegion($code)
    {
      $response = Yii::$app->response;
      $response->format = \yii\web\Response::FORMAT_JSON;
      $citys = City::findAll(['region_id' => $code]);
      if($citys){
        $response->data = ['success' => true, 'data' => $citys];
      }else{
        $response->data = ['success' => false];
      }
      return $response->data;
//      return json_encode($citys);
    }

    public function actionPolitic()
    {
      return $this->renderFile(__DIR__ . '/../views/site/politic.php');
    }

}
