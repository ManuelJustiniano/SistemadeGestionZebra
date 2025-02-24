<?php

use kartik\widgets\StarRating;
use yii\helpers\Url;

$script = <<<CSS
.border-prod {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f1f0f1;
    height: auto;
    overflow: hidden;
    text-align: center;
}
.rating-container .clear-rating {
    display: none;
}
.rating-container .caption {
    display: none;
}

#boxcuadro{
height: 298px;
}
@media (min-width: 992px) and (max-width: 1199px) {
#boxcuadro{
height: 225px!important;
}
}

@media (min-width: 768px) and (max-width: 991px) {
#boxcuadro{
height: 225px!important;
}
}


@media  (max-width: 767px) {
#boxcuadro{
height: 225px!important;
}
.ch_element.ch_wrapper{
    margin: 0 auto;
    
}
}



.rating-container .star {
    color: black;
    display: inline-block;
    font-size: 15px;
    margin: 0 3px;
    text-align: center;
}






CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);
?>


<div class="border-prod">
    <div id="boxcuadro">
        <?php if ($value['foto']): ?>
            <img src="<?= Url::to($value['foto']) ?>" alt="<?= $value['titulo'] ?>"
                 class="img-responsive" width="261px" height="263px">
        <?php else: ?>
            <img src="<?= Url::to('@web/assets_b/web/images/nosotros1.jpg') ?>" alt="productos"
                 class="img-responsive">
        <?php endif; ?>

        <div class="contenthover">
            <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>"
               class="enlace-carrito hint--top hint--success" data-hint="Ver Producto"><span
                        class="glyphicon glyphicon-eye-open"></span></a>

            <a href="#" class="enlace-carrito hint--top hint--success" data-hint="Lista de deseo"><span
                        class="glyphicon glyphicon-heart"></span></a>

            <?php
            /*$cantidad = $value->getCantidad();
            if (!empty($cantidad['saldo'])):
                ?>

                <a href="<?= Url::to(['carrito/add/', 'id' => $value['idproducto']]) ?>"
                   class="enlace-carrito hint--top hint--success"
                   data-hint="Añadir al Carrito"><span class="glyphicon glyphicon-car"></span></a>

            <?php else: ?>
            <?php endif;*/ ?>

        </div>

        <div class="preciopromo">


            <div class="espacio active"></div>
            <div class="precios prmp">
                <?php  $time = new \DateTime('now');
                $today = $time->format('Ymd');
                $model2 = $value->promocion;  if ($model2): ?>
                    <?php $tmp = date('Ymd', strtotime($model2['fechafinal'])) ?>
                    <?php if ($tmp >= $today): ?>
                        <p class=" tepromo text-ailerol14 text-gray text-left no-margin">
                            <img src="<?= Url::to('@web/assets_b/web/images/tip.png') ?>" class="margin-right15" height="35px">
                            <?php
                            echo '<span>' . "Quedan " . ($tmp - $today) . " Dia(s)" . '</span>';
                            ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>


    </div>
    <div class="boxtexto active">
        <p class="text-aileronsb14"
           style="height: 35px"><?= \yii\helpers\StringHelper::truncate($value['titulo'], 40) ?></p>
        <?php
        echo StarRating::widget([
            'name' => 'rating_2',
            'value' => 5,
            'disabled' => true
        ]);
        ?><br>
        <div class="text-ailerol16">

            <?php
            $time = new \DateTime('now');
            $today = $time->format('Ymd');
            $model2 = $value->promocion;
            if ($model2): ?>
                <?php $tmp = date('Ymd', strtotime($model2['fechafinal'])) ?>
                <?php if ($tmp >= $today): ?>
                    <span class="pull-left"><?= $model2['precio'] ?>BS </span>
                    &nbsp;&nbsp;-&nbsp;&nbsp;
                    <span class="pull-right text-gray"><s><?= $value['precio'] ?>BS</s></span>
                <?php else: ?>
                    <span class="text-center"><?= $value['precio'] ?>BS</span>
                <?php endif; ?>

            <?php else: ?>
                <span class="text-center"><?= $value['precio'] ?>BS</span>
            <?php endif; ?>

        </div>
    </div>




    <div class="clearfix"></div>
</div>


<?php
$script = <<<JS
JS;
//$this->registerJs($script, \yii\web\View::POS_READY); ?>
