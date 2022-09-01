<?php


namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

class IndexForm extends Model
{
  public $name;
  public $email;
  public $tel;
  public $text;
  public $reCaptcha;

  public function rules()
  {
    return [
      [['name', 'email', 'text'], 'required', 'message' => 'заполните это поле !'],
      ['email', 'email'],
      ['name', 'string', 'length' => [3, 30], 'message' => 'имя должно быть от 3 до 30 символов!'],
      ['tel', 'string', 'length' => [11, 30]],
      ['text', 'string', 'length' => [2, 2000],  'message' => 'текст должен быть быть от 2 до 2000 символов!'],
      /*[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
          'secret' => Yii::$app->params['secretV2'], // unnecessary if reСaptcha is already configured
          'uncheckedMessage' => 'Подтвердите, что вы не робот'],*/
      // на главной V3 использую!
      [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::class,
        'secret' => Yii::$app->params['secretV3'], // unnecessary if reСaptcha is already configured
        'threshold' => 0.5,
        'action' => 'index',
        'message' => 'Не пройдена reCaptcha!, повторите попытку.'
      ],
    ];
  }

  public function attributeLabels()
  {
    return [
      'reCaptcha' => '',
      'name' => 'Имя',
      'tel' => 'Тел.',
      'text' => 'Текст',
    ];
  }

  public function mailSend()
  {
    /* Отправка почты */
    $name = mb_ucfirst(clr_get($this->name));
    $email = clr_get($this->email);
    $tel = $this->tel ? '<br>Тел: ' . clr_get($this->tel) . '<br>' : null;
    $text = clr_get($this->text);

    $subject = 'Письмо с сайта Alex-art';
    $body = 'Вам пишет <b style="font-size: 120%;text-shadow: 0 1px 0 #e61b05">' . $name . '</b><br>E-mail : ' . $email . '<br> Тел : ' . $tel . '<br><br><div style="font-style: italic">' . nl2br(Html::encode($text)) . '</div>' .
      '<br><br>Сообщение отправлено с сайта <b>https:' . Yii::$app->params['siteUrl'] . '</b>';

    $success = Yii::$app->mailer->compose()
      ->setTo(Yii::$app->params['bk_email'])
      ->setFrom([Yii::$app->params['sender_email'] => Yii::$app->params['siteUrl']])
//            ->setFrom(['mail@alexart.houme21.ru' => 'alexart.houme21.ru'])
      ->setReplyTo([$email => $name])
      ->setSubject($subject)
      ->setHtmlBody($body)
      ->send();
    return $success;
  }

}