<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
use yii\helpers\Url;

use yii\helpers\Html;
$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);


 ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 top-spacing4">
            <br>
            <h3 class="text-ailerol34">EVENTOS</h3>

            <a href="<?= Url::to(['registrareventos']) ?>">Registrar Eventos </a>
           <br>


        </div>
    </div>
    <div class="row"><br><br><br><br><br><br></div>
</div>





