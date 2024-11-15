<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

\app\assets_b\AppAsset::register($this);
$model = new  \app\models\Forget();
$this->title = 'Recuperar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default carw">
                <div class="panel-heading">
                    <h1 class="text-center">Recuperar Contrase&ntilde;a</h1>
                </div>

                <div class="panel-body">
                    <br>

                        <p> Ingrese su correo electronico para realizar la recuperacion de contrase&ntilde;a, recuerde que la
                            informacion
                            proporcionada sera via correo electronico.</p>
                        <br>
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-md-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-md-4 control-label'],
                            ],
                        ]); ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Ingrese su correo electronico']) ?>


                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11 text-center">
                                <br>
                                <div class="col-sm-6 col-xs-12">
                                <?= Html::a('Volver atras', Url::to(['site/login']), ['class' => 'btn app-btn-primary w-100 theme-btn mx-auto']); ?>
                            </div>  <div class="col-sm-6 col-xs-12">
                                <?= Html::submitButton('ENVIAR', ['class' => 'btn app-btn-primary w-100 theme-btn mx-auto ', 'name' => 'login-button']) ?>
                        </div> </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                    <br>

                </div>
            </div>

        </div>
    </div>
</div>

<?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?php /*= \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);*/
    \yii2mod\alert\Alert::widget([
        'useSessionFlash' => false,
        'options' => [
            'type' => (!empty($message['type'])) ? $message['type'] : 'error',
            'title' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
            'animation' => "slide-from-top",
        ],
    ]); ?>
<?php endforeach; ?>