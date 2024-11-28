<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
use yii\helpers\Html;
$configuracion = \app\models\Configuracion::find()->one();
$winner = Yii::$app->session->getFlash('winner');
?>



<?php if ($winner): ?>
    <div class="alert alert-success">
        <?= Html::encode($winner) ?>
    </div>
    <?= Html::a('Reiniciar Juego', ['reset'], ['class' => 'btn btn-primary']) ?>
<?php else: ?>
    <table class="table table-bordered text-center" style="width: 300px; margin: auto;">
        <?php foreach ($board as $rowIndex => $row): ?>
            <tr>
                <?php foreach ($row as $colIndex => $cell): ?>
                    <td style="height: 100px; width: 100px;">
                        <?php if ($cell === ''): ?>
                            <?= Html::a('&nbsp;', ['play', 'row' => $rowIndex, 'col' => $colIndex], ['class' => 'btn btn-light', 'style' => 'width:100%; height:100%;']) ?>
                        <?php else: ?>
                            <strong><?= Html::encode($cell) ?></strong>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <div style="margin-top: 20px;">
        <?= Html::a('Deshacer', ['undo'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Reiniciar Juego', ['reset'], ['class' => 'btn btn-primary']) ?>
    </div>
<?php endif; ?>







