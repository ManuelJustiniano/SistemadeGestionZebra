<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?= Yii::$app->homeUrl ?>"><b>Administrador</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Ingreso a sistema</p>
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
    </div>
    <br>

    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
