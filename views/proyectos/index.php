<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'PROYECTOS';
?>
<?php
$format = <<< SCRIPT
function format(state) {
if (!state.id) return state.text; // optgroup
return state.text;
}
SCRIPT;
$escape = new \yii\web\JsExpression("function(m) { return m; }");
$this->registerJs($format, \yii\web\View::POS_HEAD);


?>

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
                case 'listap':
                    echo $this->render('listap', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
                    break;
                case 'milista':
                    echo $this->render('milista', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
                    break;
                case 'view':
                    echo $this->render('view', ['model' => $model]);
                    break;
                case 'create':
                    echo $this->render('create', ['model' => $model]);
                    break;
                case 'update':
                    echo $this->render('update', ['model' => $model]);
                    break;
                case 'asignar':
                    echo $this->render('asignar', ['model' => $model]);
                    break;
                case 'editasignar':
                    echo $this->render('editasignar', ['model' => $model]);
                    break;


            }
        }
        ?>
        <!--/container-main-->

    </div><!--//app-wrapper-->

