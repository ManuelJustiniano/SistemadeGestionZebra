<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$model = new  \app\models\Forget();
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="container">
    <div class="row">
        <br> <br>
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
                        <br><br>
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
                                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-default ', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>

