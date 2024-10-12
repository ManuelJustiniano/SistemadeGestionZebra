<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginWeb */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>




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


                    <?php $form = ActiveForm::begin(['class' => 'form-signin']); ?>

                    <?= $form->field($model, 'username', [
                        'inputOptions' => ['placeholder' => 'Usuario'],
                        'inputTemplate' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-user form-control-feedback"></span></div>',
                    ])->label(false) ?>
                    <?= $form->field($model, 'password', [
                        'inputOptions' => ['placeholder' => 'Contraseña'],
                        'inputTemplate' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span></div>',
                    ])->label(false)->passwordInput() ?>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" value="remember-me"> Recordarme
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <?php ActiveForm::end(); ?>


                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-8 col-md-10\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 col-md-3 control-label'],
                        ],
                    ]); ?>




                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8  col-lg-offset-3">
                            <?= Html::a('¿Has olvidado tu contraseña?',['/cuenta/forget'],['class'=>'olvidaste'])?>
                        </div>


                    </div>


                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>


<br> <br>
