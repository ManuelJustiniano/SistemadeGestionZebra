<?php
$originalDateini = $model->fecha_inicio ?? null;
$newDatei = date("d/m/Y", strtotime($originalDateini));
$originalDatefin = $model->fecha_fin ?? null;
$newDatef = date("d/m/Y", strtotime($originalDatefin));
$user = Yii::$app->session->get('user');
use yii\helpers\Url;

$format = <<< SCRIPT
function format(state) {
if (!state.id) return state.text; // optgroup
return state.text;
}
SCRIPT;
$escape = new \yii\web\JsExpression("function(m) { return m; }");
$this->registerJs($format, \yii\web\View::POS_HEAD);
use kartik\select2\Select2;
use kartik\form\ActiveForm;
?>

<div class="card">
    <div class="card-body">


        <h5 class="card-title pohacer">POR HACER  (<?= \app\models\Asignacion::find()->where(['idproyecto'=>$model->idproyecto, 'estado' =>'1'])->count() ?>)</h5>

              <?php $porhae = \app\models\Asignacion::find()->where(['idproyecto'=> $model->idproyecto, 'estado' =>'1'])->all()?>

            <?php foreach ($porhae as $item):?>
                    <p><?php echo $item->tareas->titulo ?>

                <?php if ($user->tipo_usuario == '3' || $user->tipo_usuario == '4') : ?>

                    <a href="#" class="btn aceptar-tarea" data-id="<?= $item->idasignartarea ?>" data-url="<?= \yii\helpers\Url::to(['proyectos/aceptar-tarea']) ?>">Aceptar </a>




                <?php endIf; ?>

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




<script>
    $(document).on('click', '.aceptar-tarea', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('url');
        console.log('ID capturado:', id); // Verifica que este log muestre el ID correcto.

        $.ajax({
            url: '<?= \yii\helpers\Url::to(['proyectos/aceptar-tarea']) ?>?id=' + id, // Pasar el ID como parámetro en la URL
            type: 'POST',
            data: {
                _csrf: '<?= Yii::$app->request->csrfToken ?>'
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Error al intentar aceptar la tarea.');
                console.log(xhr.responseText);
            }
        });
    });



</script>