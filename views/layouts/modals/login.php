<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

?>
<!-- line modal login -->
<div class="modal  fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Iniciar Sesión</h3>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'frmContact', 'action' => ['site/login'], 'method' => 'post']);
            $login = New \app\models\LoginWeb();
            ?>
            <div class="modal-body">
                <!-- content goes here -->
                <?= $form->field($login, 'username', ['inputOptions' => ['placeholder' => 'Email']])->label(false) ?>
                <?= $form->field($login, 'password', ['inputOptions' => ['placeholder' => 'Contraseña']])->passwordInput()->label(false) ?>

                <?= Html::a('¿Has olvidado tu contraseña?',['/cuenta/forget'],['class'=>'olvidaste'])?>


            </div>


            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group col-sm-4" role="group">
                        <?= Html::submitButton('Aceptar', ['class' => 'btn btn-success btn-hover-green', 'name' => 'contact-button']) ?>
                    </div>
                    <div class="btn-group col-sm-4" role="group">
                        <button type="button" class="btn  btn-danger" data-dismiss="modal" role="button">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>