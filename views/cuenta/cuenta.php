<?php
$user = Yii::$app->session->get('user');
?>

<?= $this->render('widgets/menu') ?>




<div class="app-wrapper">



                <?php
                if (isset($render)) {
                    switch ($render) {
                        case 'cuenta':
                            echo $this->render('cuenta', ['model' => $model]);
                            break;
                        case 'updateperfil':
                            echo $this->render('updateperfil', ['model' => $model]);
                            break;
                        case 'updatepasswordperfil':
                            echo $this->render('updatepasswordperfil', ['model' => $model]);
                            break;
                        case 'historial':
                            echo $this->render('historial', ['model' => $model]);
                            break;
                    }
                }
                ?>
                <!--/container-main-->


            </div><!--//app-wrapper-->
