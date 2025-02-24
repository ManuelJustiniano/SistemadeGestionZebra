<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$model = new  \app\models\LoginWeb();
$this->title = 'Login';

$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('../site/banners/fijo', ['titulo' => 'Login']) ?>


<div class="container">
    <div class="row">
        <br> <br>
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default carw">
                <div class="panel-heading">
                    <h1 class="text-center">Iniciar Session</h1>
                </div>

                <div class="panel-body">
                    <br>


                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-8 col-md-10\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 col-md-3 control-label'],
                        ],
                    ]); ?>


                    <div class="col-xs-12 ">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-xs-12 0">

                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>

                    <div class="col-xs-12 ">
                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => "<div class=\"col-lg-offset-3 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        ]) ?>

                    </div>

                    <div class="col-xs-12 ">

                    </div>


                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8  col-lg-offset-3">
                            <?= Html::a('¿Has olvidado tu contraseña?',['/cuenta/forget'],['class'=>'olvidaste'])?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8  col-lg-offset-3">
                            <?= Html::submitButton('Aceptar', ['class' => 'btn btn-success btnpag btn-block btn-md', 'name' => 'login-button']) ?>

                        </div>

                    </div>


                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>


<br> <br>
