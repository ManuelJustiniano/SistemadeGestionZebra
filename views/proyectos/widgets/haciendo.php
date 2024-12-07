<?php
$originalDateini = $model->fecha_inicio ?? null;
$newDatei = date("d/m/Y", strtotime($originalDateini));
$originalDatefin = $model->fecha_fin ?? null;
$newDatef = date("d/m/Y", strtotime($originalDatefin));
?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title hacendo">EN PROGRESO  (<?= \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'2'])->count() ?>)</h5>

        <?php $porprgres = \app\models\Asignacion::find()->where(['idproyecto'=> $model->idproyecto, 'estado' =>'2'])->all()?>

        <?php foreach ($porprgres as $item):?>
            <p><?php echo $item->tareas->titulo ?>

                <?php if ($item->aceptacionadmin == '1') : ?>
                <button type="button" class="btn btn-primary btmopr"  data-bs-toggle="modal" data-bs-target="#modal<?= $item->idasignartarea ?>">
                    Aceptar confirmacion
                </button>
                <?php endif; ?>


                <br><span class="consultoresasi"><i class="fa-solid fa-user-tie"></i>  <?php echo $item->consultor->nombrecompleto ?></span>
                <br><span class="consultoresasi"><i class="fa-solid fa-calendar"></i>  <strong>Del </strong> <?php echo $newDatei ?>  <strong> hasta el </strong> <?php echo $newDatef ?> </span>
                <br>
                <?php
                switch ($item->prioridad) {
                    case 'Alta':
                        $clasePrioridad = 'pralta';
                        break;
                    case 'Media':
                        $clasePrioridad = 'prmedia';
                        break;
                    case 'Baja':
                        $clasePrioridad = 'prbaja';
                        break;
                    default:
                        $clasePrioridad = 'sinprioridad';
                        break;
                }

                ?>

                <span class=" <?= $clasePrioridad ?> consultoresasi">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <?php echo $item->prioridad  ?>
                        </span>

                <br>
                <span class="  consultoresasi">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <?php  if ($item->aceptacionadmin == '1') :  ?>
                            Pendiente de aceptacion Admin
                            <?php  else:   ?>
                            Aceptada por Admin
                            <?php  endIf   ?>
                        </span>

                <br>
                <span class="  consultoresasi">
                            <?php  echo $item->comentario  ?>
                        </span>


            </p>

                    <div class="modal " id="modal<?= $item->idasignartarea ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confimar Aceptacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body desproyecto">
                                    <form id="formGestionTarea<?= $item->idasignartarea ?>">
                                        <input type="hidden" id="idTarea<?= $item->idasignartarea ?>" value="<?= $item->idasignartarea ?>" name="idTarea">
                                        <div class="mb-3">
                                            <label for="estadoTarea<?= $item->idasignartarea ?>" class="form-label">Estado</label>
                                            <select class="form-select" id="estadoTarea<?= $item->idasignartarea ?>" name="estadoTarea" required>
                                                <option value="2">Aceptada</option>
                                                <option value="1">Pendiente</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="comentarioTarea<?= $item->idasignartarea ?>" class="form-label">Comentario</label>
                                            <textarea class="form-control" id="comentarioTarea<?= $item->idasignartarea ?>" name="comentarioTarea" rows="3" required></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary guardarGestionTarea" data-id="<?= $item->idasignartarea ?>">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php endforeach;?>
    </div>
</div>



<script>
    $(document).on('click', '.guardarGestionTarea', function () {
        var id = $(this).data('id');
        var estado = $('#estadoTarea' + id).val();
        var comentario = $('#comentarioTarea' + id).val();

        $.ajax({
            url: '<?= \yii\helpers\Url::to(['proyectos/confirmar-aceptacion']) ?>',
            type: 'POST',
            data: {
                idTarea: id,
                estadoTarea: estado,
                comentarioTarea: comentario,
                _csrf: '<?= Yii::$app->request->csrfToken ?>'
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                alert('Error al intentar gestionar la tarea.');
                console.log(xhr.responseText);
            }
        });
    });
</script>