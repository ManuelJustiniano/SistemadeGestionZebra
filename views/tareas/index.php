<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'TAREAS';
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

<?php
if ($tipo_usuario == '1') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Mi cuenta', 'url' => ['administrador/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mensajes', 'url' => ['/cuenta/perfil'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Materiales', 'url' => ['/cuenta/perfil'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'administrador',
    ]);
} elseif ($tipo_usuario == '2') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Mi cuenta', 'url' => ['gestor/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'gestor',
    ]);
}
?>

<div class="app-wrapper">


<?php
        if (isset($render)) {
            switch ($render) {
                case 'view':
                    echo $this->render('view', ['model' => $model]);
                    break;
                case 'create':
                    echo $this->render('create', ['model' => $model]);
                    break;
                case 'update':
                    echo $this->render('update', ['model' => $model]);
                    break;


            }
        }
        ?>
        <!--/container-main-->

</div>
