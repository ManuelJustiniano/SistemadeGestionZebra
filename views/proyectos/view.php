<?php
use yii\helpers\Url;
$user = Yii::$app->session->get('user');
$originalDateini = $model->fecha_inicio ?? null;
$newDatei = date("d/m/Y", strtotime($originalDateini));
$originalDatefin = $model->fecha_fin ?? null;
$newDatef = date("d/m/Y", strtotime($originalDatefin));
$this->title = 'PROYECTO';
?>


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <div class="row">
        <div class="col-12 col-sm-6">
            <h1 class="app-page-title inlesblo">PROYECTO: <span class="colon"> <?= $model['titulo']?>. </span></h1>

            <button type="button" class="btn btn-primary btmopr" data-bs-toggle="modal" data-bs-target="#basicModal">
             Ver detalles
            </button>


        </div>
        <div class="col-12 col-sm-6">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="<?= Url::to(['proyectos/update?id='.$model['idproyecto']]) ?>">Editar Proyecto</a>
                <a class="btn app-btn-secondary" href="<?= Url::to(['proyectos/asignaciondetareas', 'idproyecto' => $model['idproyecto']]) ?>">Asignar tareas y consultores</a>
            </div>
        </div>
        </div>
        <div class="col-12">
            <div class="row">
        <div class="card">
            <div class="card-body">

                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-" role="presentation">
                        <button class="nav-link " id="informacion-b" data-bs-toggle="tab" data-bs-target="#informacion" type="button" role="tab" aria-controls="home" aria-selected="false" tabindex="-1">INFORMACIÓN</button>
                    </li>
                    <li class="nav-item flex-" role="presentation">
                        <button class="nav-link active" id="tablero-b" data-bs-toggle="tab" data-bs-target="#tablero" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">TABLERO DE TAREAS</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane " id="informacion" role="tabpanel" aria-labelledby="informacion-b">
                        <div class="row gy-4">
                            <div class="col-12 cardtareas">
                                <div class="col-xxl-12 col-md-12">
                                <p style="display: block!important;"> <strong> Total Tareas:  </strong>  <?= \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto])->count();?>
                                </p>
                                </div>
                                <div class="col-xxl-3 col-md-3">
                                    <?= $this->render('../widgets/tarjetas', ['titulo' => 'TOTAL TAREAS EN ESPERA','icono' => '<i class="fa fa-list" aria-hidden="true"></i>', 'numero' =>  \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'1'])->count()]) ?>
                                </div>

                                <div class="col-xxl-3 col-md-3 col-xl-6">
                                    <?= $this->render('../widgets/tarjetas', ['titulo' => 'TOTAL TAREAS EN CURSO','icono' => '<i class="fa fa-list" aria-hidden="true"></i>', 'numero' =>  \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'2'])->count()]) ?>
                                </div>

                                <div class="col-xxl-3 col-md-3 col-xl-6">
                                    <?= $this->render('../widgets/tarjetas', ['titulo' => 'TOTAL TAREAS COMPLETADAS','icono' => '<i class="fa fa-list" aria-hidden="true"></i>', 'numero' =>  \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'3'])->count()]) ?>
                                </div>

                                <div class="col-xxl-3 col-md-3 col-xl-6">
                                    <?= $this->render('../widgets/tarjetas', ['titulo' => 'TOTAL TAREAS VENCIDAS','icono' => '<i class="fa fa-list" aria-hidden="true"></i>', 'numero' =>  \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'3'])->where(['<', 'fechafin', new \yii\db\Expression('NOW()')])->count()]) ?>
                                </div>


                            </div><!--//col-->




                            <div class="col-12 cardtareas">
                            <div class="col-xxl-12 col-md-6">
                                <div class="examples">

                                </div>

                            </div>
                            </div>
                       </div><!--//row-->
                    </div>
                    <div class="tab-pane active tablesckai" id="tablero" role="tabpanel" aria-labelledby="tablero-b">

                        <div class="row gy-4">
                            <div class="col-12 cardtareas">


                                <div class="col-lg-4 col-xs-12">
                                    <?= $this->render('widgets/porhacer', ['model' =>  $model]) ?>

                                </div>



                                <div class="col-lg-4 col-xs-12">
                                    <?= $this->render('widgets/haciendo', ['model' =>  $model]) ?>
                                </div>



                                <div class="col-lg-4 col-xs-12">
                                    <?= $this->render('widgets/finalizadas', ['model' =>  $model]) ?>
                                </div>

                    </div>
                    </div>
                    </div>

                </div><!-- End Bordered Tabs Justified -->

            </div>
        </div>
        </div>
        </div>


    </div><!--//container-fluid-->
</div><!--//app-content-->




<div class="modal " id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body desproyecto">



                            <p> <strong>Cliente:</strong> <?= $model->usuario['nombrecompleto'] ?></p>
                            <p> <strong>Prioridad:</strong> <?= strip_tags($model['prioridad']) ?></p>
                            <p> <strong>Fecha Inicio:</strong> <?= $newDatei ?></p>
                            <p> <strong>Fecha Fin:</strong> <?= $newDatef ?></p>
                            <p> <strong>Gestor encargado:</strong> <?= $model->gestor['nombrecompleto'] ?></p>
                            <p> <strong>Descripcion:</strong> <?= strip_tags($model['descripcion']) ?></p>


            </div>

        </div>
    </div>
</div><!-- End Basic Modal-->

<?php



?>