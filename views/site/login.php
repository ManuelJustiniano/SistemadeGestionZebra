<?php
use app\assets_b\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>

<div class="container">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <h2 class="auth-heading text-center mb-5">INICIAR SESION</h2>
                    <div class="auth-form-container text-start">




                        <?php $form = ActiveForm::begin(['class' => 'auth-form login-form']); ?>

                            <div class="email mb-3">


                                <?= $form->field($model, 'username', [
                                    'inputOptions' => ['placeholder' => 'Usuario', 'class' => 'form-control signin-email'],
                                ])->label(false) ?>

                            </div><!--//form-group-->
                            <div class="password mb-3">

                                <?= $form->field($model, 'password', [
                                    'inputOptions' => ['placeholder' => 'Contraseña', 'class' =>'form-control signin-password' ],

                                ])->label(false)->passwordInput() ?>



                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">


                                        <?= $form->field($model, 'rememberMe')->checkbox([
                                            'template' => "<div class=\"\">{input} <label>Recuerdame</label></div>\n<div class=\"col-lg-12\">{error}</div>",

                                        ]) ?>





                                    </div><!--//col-6-->
                                    <div class="col-6">
                                        <div class="forgot-password text-end">
                                            <?= Html::a('¿Has olvidado tu contraseña?',['/cuenta/forget'],['class'=>'olvidaste'])?>
                                        </div>
                                    </div><!--//col-6-->
                                </div><!--//extra-->
                            </div><!--//form-group-->
                            <div class="text-center">
                                <?= Html::submitButton('Ingresar', ['class' => 'btn app-btn-primary w-100 theme-btn mx-auto', 'name' => 'login-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>






                        <!-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html" >here</a>.</div> -->
                    </div><!--//auth-form-container-->

                </div><!--//auth-body-->


            </div><!--//flex-column-->
        </div><!--//auth-main-col-->


    </div><!--//row-->










