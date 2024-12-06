
<?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?= \yii2mod\alert\Alert::widget([
        'useSessionFlash' => false,
        'options' => [
            'type' => (!empty($message['type'])) ? $message['type'] : 'error',
            'title' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : '¡Algo salió mal!',
            'animation' => "slide-from-top",
        ],
    ]); ?>
<?php endforeach; ?>



<?= $this->render('../widgets/opciones') ?>
<div class="app-wrapper">
                <?php
                if (isset($render)) {
                    switch ($render) {
                        case 'listau':
                            echo $this->render('listau', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
                            break;
                        case 'verusuario':
                            echo $this->render('verusuario', ['model' => $model]);
                            break;
                        case 'createusuario':
                            echo $this->render('createusuario', ['model' => $model]);
                            break;
                        case 'updateusuario':
                            echo $this->render('updateusuario', ['model' => $model]);
                            break;
                        case 'perfil':
                            echo $this->render('perfil', ['model' => $model]);
                            break;
                        case 'updateperfil':
                            echo $this->render('updateperfil', ['model' => $model]);
                            break;
                        case 'updatepasswordperfil':
                            echo $this->render('updatepasswordperfil', ['model' => $model]);
                            break;
                    }
                }
                ?>
                <!--/container-main-->
            </div><!--//app-wrapper-->
