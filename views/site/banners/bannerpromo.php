<?php

use yii\helpers\Url;


$time = new \DateTime('now');
$today = $time->format('y-m-d');
$model2 = \app\models\Promociones::find()
    ->where(['>=', 'fechafinal', $today])
    ->orderBy(['rand()' => SORT_DESC])
    ->limit(2)
    ->all();

?>


<div class="container">
    <div class="row full-width-row top-spacing3 bottom-spacing2">
        <div>
            <?php foreach ($model2 as $row_banner3): ?>
                <div class="col-md-6 col-sm-6" style="margin-bottom: 10px">
                    <a href=" <?= Url::to(['producto/' . $row_banner3['idproducto']]) ?> "><img
                                src="<?= Url::to($row_banner3['foto']) ?>" alt="Promosion1" class="img-responsive"></a>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>








