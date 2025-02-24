<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);
$script = <<<CSS

.form-group {
       margin-bottom: 5px;
}

CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);

?>
<?= $this->render('banners/fijo', ['titulo' => 'Contacto']) ?>




<div class="container">
    <div class="mapa" style="
    margin-bottom: 70px;
">
        <?php echo $configuracion['coordgoogle'] ?>

    </div><!-- End #map -->

    <div class="row">

        <div class="col-md-8">
            <h2 class="light-title">Formulario <strong> de Contacto </strong></h2>

            <?php $form = ActiveForm::begin(['id' => 'frmContact', 'options' => ['class' => 'top-spacing3'], 'action' => ['correo/contacto'], 'method' => 'post']); ?>


            <form action="#">
                <div class="form-group required-field">
                    <label for="contact-name">Nombre</label>
                    <?= $form->field($model, 'nombre')->label(false)->textInput(['autofocus' => true, 'placeholder' => '', 'class' => 'form-control', 'required' => true]) ?>

                </div><!-- End .form-group -->

                <div class="form-group required-field">
                    <label for="contact-email">Email:</label>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => '', 'class' => 'form-control', 'required' => true]) ?>


                </div><!-- End .form-group -->

                <div class="form-group">
                    <label for="contact-phone">Teléfono:</label>
                    <?= $form->field($model, 'telefono')->textInput(['placeholder' => '', 'class' => 'form-control', 'required' => true]) ?>

                </div><!-- End .form-group -->

                <div class="form-group required-field">
                    <label for="contact-message">Consulta:</label>

                    <?= $form->field($model, 'mensaje')->textarea(['class' => 'form-control', 'rows' => 5, 'placeholder' => '']) ?>
                    <?= $form->field($model, 'reCaptcha')->label(false) ->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::className(),
                        ['siteKey' => '6LfaTE4UAAAAAPN-oh3x6NDWNoJdZqWhICZ_qwfX']
                    ) ?>


                </div><!-- End .form-group -->

                <div class="form-footer">

                    <?= Html::submitButton('Enviar mensaje', ['class' => 'btn btn-primary', 'name' => 'contact-button ']) ?>

                </div><!-- End .form-footer -->
            </form>


            <?php ActiveForm::end(); ?>



        </div><!-- End .col-md-8 -->

        <div class="col-md-4">
            <h2 class="light-title">Información de  <strong>Contacto</strong></h2>

            <div class="contact-info">
                <div>
                    <i class="icon-phone"></i>
                    <p><a href="tel:<?= $configuracion['telefono_empresa'] ?>"><?= $configuracion['telefono_empresa'] ?></a></p>
                </div>
                <div>
                    <i class="icon-direction"></i>
                    <p><a href=""><?= $configuracion['direccion_empresa'] ?></a></p>
                </div>
                <div>
                    <i class="icon-mail-alt"></i>
                    <p><a href="mailto:<?= $configuracion['email_web'] ?>"><?= $configuracion['email_web'] ?></a></p>
                </div>

            </div><!-- End .contact-info -->
        </div><!-- End .col-md-4 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-8"></div><!-- margin -->





