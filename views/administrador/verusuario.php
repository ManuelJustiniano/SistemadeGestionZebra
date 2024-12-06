<?php
use yii\helpers\Url;
$originalDatefechan = $model->fecha_nacimiento ?? null;
$newDatefn = date("d/m/Y", strtotime($originalDatefechan));
$tiposUsuario = \app\models\Usuarios::getTipoUsuario();
$originalDatefechreg = $model->fecha_registro ?? null;
$newDatefreg = date("d/m/Y", strtotime($originalDatefechreg));
$this->title = 'PERFIL USUARIO';
$proyectoscomocliente = \app\models\Proyectos::find()->where(['idcliente' => $model['idusuario']])->all();
$proyectoscomogestor  = \app\models\Proyectos::find()->where(['idgestor' => $model['idusuario']])->all();
$proyectoscomoconsultor = \app\models\Proyectos::find()->joinWith('asignartareas')
->where(['asignartareas.idconsultor' => $model['idusuario']])
    ->all();
?>



<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="col-12 col-sm-6">
            <h1 class="app-page-title">Usuario: <?php echo $model['nombrecompleto'] ?></h1>
        </div>
        <div class="col-12 col-sm-6">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="<?= Url::to(['administrador/update?id='. $model['idusuario']]) ?>">Editar Perfil</a>
            </div><!--//app-card-footer-->
        </div>
        <div class="row gy-4">
            <div class="col-12">
                <div class="app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-body px-4 w-100">
                        <h1 class="app-page-title">INFORMACION GENERAL:</h1>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Nombre Completo', 'datos' =>  $model['nombrecompleto']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Usuario', 'datos' =>  $model['usuario']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Tipo usuario', 'datos' =>  $tiposUsuario[$model->tipo_usuario]]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Email', 'datos' =>  $model['email']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Telefono', 'datos' =>  $model['telefono']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Movil', 'datos' =>  $model['movil']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Sexo', 'datos' =>  $model['sexo']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'fecha de nacimiento', 'datos' =>  $newDatefn]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'fecha registro', 'datos' =>  $newDatefreg]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Empresa', 'datos' =>  $model['nombrecompleto']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Cargo', 'datos' =>  $model['cargo']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Pais', 'datos' =>  $model['pais']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Ciudad', 'datos' =>  $model['ciudad']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Direccion', 'datos' =>  $model['direccion']]) ?>






                    </div><!--//app-card-body-->


                </div><!--//app-card-->
            </div><!--//col-->

            <div class="col-12">
                <div class="app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-body tanlaprusi px-4 w-100">

                <h1 class="app-page-title ">PROYECTOS:</h1>
                <?php
                $proyectos = array_merge($proyectoscomocliente, $proyectoscomogestor, $proyectoscomoconsultor);
                $proyectosUnicos = array_unique($proyectos, SORT_REGULAR);
                ?>


                        <?php if (!empty($proyectos)): ?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Proyecto</th>
                                <th>Tareas Asignadas</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($proyectos as $proyecto): ?>
                                <tr>
                                    <td><?= htmlspecialchars($proyecto->titulo) ?></td>

                                    <td>
                                        <?php
                                        $tareasAsignadascliente = \app\models\Asignacion::find()->select(['idtarea'])->distinct()->where(['idproyecto' => $proyecto->idproyecto])->all();
                                        $tareasAsignadasconsultor = \app\models\Asignacion::find()->where(['idproyecto' => $proyecto->idproyecto, 'idconsultor' => $model->idusuario  ])->all();
                                        ?>
                                        <ul>
                                            <?php if ($model->tipo_usuario == '3'): ?>

                                            <?php foreach ($tareasAsignadasconsultor as $tarea): ?>
                                                <li><?= htmlspecialchars($tarea->tareas->titulo) ?></li>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <?php foreach ($tareasAsignadascliente as $tarea): ?>
                                                <li><?= htmlspecialchars($tarea->tareas->titulo) ?></li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </td>

                                    <td>
                                        <a href="<?= \yii\helpers\Url::to(['proyectos/view', 'id' => $proyecto->idproyecto]) ?>" style="color: white!important;" class="btn btn-primary">
                                            Ver Proyecto
                                        </a>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <p>No hay proyectos asignados a este usuario.</p>
                        <?php endif; ?>




            </div>
            </div>
            </div>


        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->


