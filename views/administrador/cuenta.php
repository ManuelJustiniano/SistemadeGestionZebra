<?php
$user = Yii::$app->session->get('user');
?>

<?= $this->render('../widgets/menu', [
    'lista' => [
        'items' => [
            ['label' => 'Mi cuenta', 'url' => ['administrador/cuenta'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Mensajes', 'url' => ['/administrador/perfil'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Materiales', 'url' => ['/administrador/perfil'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Usuarios', 'url' => ['/administrador/usuarioslist'], 'options' => ['class' => 'nav-item']],
        ],
    ], 'tipousuario' => 'administrador',
]) ?>


<div class="app-wrapper">



                <?php
                if (isset($render)) {
                    switch ($render) {
                        case 'listau':
                            echo $this->render('listau', ['model' => $model]);
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
