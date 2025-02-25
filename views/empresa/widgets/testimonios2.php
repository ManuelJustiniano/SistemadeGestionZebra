<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$configuracion = \app\models\Configuracion::find()->one();

$script = <<<CSS
CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);

?>

<?php $testimonios = \app\models\Testimonios::find()->where(['estado' => '1'])->orderBy(['idtestimonio' => SORT_DESC])->limit('50')->all() ?>



<div class="testimonials-slider owl-carousel owl-theme">
    <?php foreach ($testimonios

    as $item): ?>

    <div class="testimonial">
        <div class="testimonial-owner">


            <div>
                <h4 class="testimonial-title"><?php echo $item['titulo'] ?></h4>
                <span><?php echo $item['puesto'] ?></span>
            </div>
        </div><!-- End .testimonial-owner -->

        <blockquote>
            <p>
                <?php echo $item['descripcion'] ?>


            </p>
        </blockquote>
    </div><!-- End .testimonial -->


    <?php endforeach; ?>


</div><!-- End .testimonials-slider -->


