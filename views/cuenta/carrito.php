<?php

use yii\helpers\Url;

?>

<div class="row top-spacing4 bottom-spacing3">

    <?php \yii\widgets\Pjax::begin() ?>

    <div class="table-responsive carw">

        <table class="table table-hover table-condensed text-cener">
            <thead>
            <tr>
                <td class="pad20">
                    <div align="center"><strong>Producto</strong></div>
                </td>
                <td class="pad20">
                    <div align="center"><strong>Descripcion</strong></div>
                </td>
                <td class="pad20">
                    <div align="center"><strong>Cantidad</strong></div>
                </td>
                <td class="pad20">
                    <div align="center"><strong>Precio (Bs.)</strong></div>
                </td>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($carrito as $item):
                ?>
                <tr>
                    <td align="center" class="pad20"><img src="<?= Url::to($item->producto->foto) ?>"
                                                          class="img-thumbnail"
                                                          style="width: 140px; height: 140px;"></td>
                    <td align="center" class="pad20"><?= $item->producto->titulo ?>
                        <br><?= $item->producto->descripcion ?></td>
                    <td align="center" class="pad20"><?= $item->cantidad ?></td>
                    <td align="center" class="pad20"><?= $item->precio ?></td>

                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>
    <?php \yii\widgets\Pjax::end() ?>

</div>

