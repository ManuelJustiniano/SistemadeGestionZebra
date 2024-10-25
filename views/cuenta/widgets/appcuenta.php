<?php
use yii\helpers\Url;
$user = Yii::$app->session->get('user');

?>

<div class="col-12 col-lg-6  " style="padding-left: 0">
<div class="item border-bottom py-3 app-card">
    <div class="row row text-left">
        <div class="col-auto">
            <div class="item-label"><strong><?php echo $label ?></strong></div>
            <div class="item-data"><?php echo $datos ?></div>
        </div><!--//col-->

    </div><!--//row-->
</div><!--//item-->
</div>