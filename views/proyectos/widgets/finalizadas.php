<?php
$originalDateini = $model->fecha_inicio ?? null;
$newDatei = date("d/m/Y", strtotime($originalDateini));
$originalDatefin = $model->fecha_fin ?? null;
$newDatef = date("d/m/Y", strtotime($originalDatefin));
?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title finalizada">FINALIZADAS  (<?= \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'3'])->count() ?>)</h5>
        <?php $porfina = \app\models\Asignacion::find()->where(['idproyecto'=> $model->idproyecto, 'estado' =>'3'])->all()?>

        <?php foreach ($porfina as $item):?>
            <p><?php echo $item->tareas->titulo ?>

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


            </p>
        <?php endforeach;?>


    </div>
</div>
