<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alexadmx\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Пользователи помеченные как удаленные');

//$model = $dataProvider->getModels(); // пока не понял откуда приходит $model
//var_dump($model);
?>
<style>
    #w1-success{
        margin-top: 80px;
    }
</style>
<br>
<br>
<h3><?= Html::encode($this->title) ?></h3>
<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'deleted';
?>

<a href="/alexadmx/user/all-in-active?status=<?= User::STATUS_DELETED ?>" class="btn btn-success">Всех активными</a>
<a href="/alexadmx/user/delete-all-bad-users?status=<?= User::STATUS_DELETED ?>" class="btn btn-danger" data-confirm="Это действие нельзя отменить.Продолжить ?">Удалить всех безвозвратно</a>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'email:email',
        'role',
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function($model)
            {
                return $model->status . '<br><a href="/alexadmx/user/set-active?id=' . $model->id . '" class="btn btn-success" style="transform: scale(.8);text-wrap: none">активным</a>';
            }

        ],
//            'auth_key',
        //'register_token:ntext',
        //'password_reset_token:ntext',
        [
            'attribute' => 'created_at',
            'value' => function($model)
            {
                return date('Y-m-d H:i:s', $model->created_at);
            }
        ],
        [
            'attribute' => 'updated_at',
            'value' => function($model)
            {
                return date('Y-m-d H:i:s', $model->updated_at);
            }
        ],
        [
            'attribute' => 'password',
            'format' => 'raw',
            'value' => function($model)
            {
                return '<a href="/alexadmx/user/setpass?id=' . $model->id . '" class="btn btn-warning" style="transform: scale(.8);text-wrap: none">изменить пароль</a>';
            }
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
