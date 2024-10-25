<?php
$user = Yii::$app->session->get('user');
?>

<?= $this->render('../widgets/menu', [
    'tipousuario' => 'gestor',
    'lista' => [
        'items' => [
            ['label' => 'Mi cuenta', 'url' => ['gestor/cuenta'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],

        ],
    ],
]) ?>


<div class="app-wrapper">



                <?php
                if (isset($render)) {
                    switch ($render) {
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
