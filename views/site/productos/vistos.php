<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$proddesta2 = \app\models\Productos::find()->where(['estado' => '1'])->orderBy(['visitas' => SORT_DESC])->limit('9')->all();

?>




<?php foreach ($proddesta2

               as $value): ?>

<div class="col-6 col-md-4">
    <div class="product">

        <figure class="product-image-container">
            <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="product-image">
                <img src="<?= Url::to($value['foto']) ?>" alt="<?php echo $value['titulo'] ?>">
            </a>
            <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="btn-quickviewlow">Ver producto</a>
        </figure>


        <div class="product-details">

            <h2 class="product-title">
                <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>">
                    <?= \yii\helpers\StringHelper::truncate($value['titulo'], 60) ?></a>
            </h2>

            <div class="price-box">



                <?php if($value['preciooferta']) :?>

                    <span class="old-price">Bs. <?= $value['preciooferta'] ?></span>
                    <span class="product-price">Bs. <?= $value['precio'] ?></span>
                <?php else:?>
                    <span class="product-price">Bs. <?= $value['precio'] ?></span>
                <?php endif;?>


            </div>



            <div class="product-action">
                <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="paction add-wishlist" title="Add to Wishlist">
                    <span>Ver producto</span>
                </a>




                <?php $form = ActiveForm::begin(['id' => 'frmContact', 'options' => ['class' => 'dealsd'], 'action' => ['carrito/add'], 'method' => 'get']); ?>






                <input type="hidden" value="<?= $value['idproducto'] ?> " name="id">






                <input type="submit" name="enviar" id="submit_contact" class="paction add-cart carlet"
                       value="Añadir al Carrito">

                <?php ActiveForm::end(); ?>




                <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="paction add-compare" title="Add to Compare">
                    <span>Ver producto</span>
                </a>
            </div><!-- End .product-action -->
        </div><!-- End .product-details -->


    </div><!-- End .product -->
</div><!-- End .col-md-4 -->



<?php endforeach; ?>














