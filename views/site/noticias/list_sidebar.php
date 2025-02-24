<?php

use yii\helpers\Url;


?>
<?php if (isset($items)): ?>
    <ul id="lista2" style="list-style-type: none; padding-left: 0;">
        <?php foreach ($items as $key => $item): ?>
            <li>
                <div class="col-md-4 no-padding col-xs-4" style=" padding-left: 0;">
                    <?php if ($item['foto_portada']): ?>
                        <img src="<?= Url::to($item['foto_portada']) ?>" alt="Mejor Oferta" class="img-responsive">
                    <?php else: ?>
                        <img src="<?= Url::to('@web/assets_b/web/images/mejor-prom.png') ?>" alt="Mejor Oferta"
                             class="img-responsive">
                    <?php endif; ?>
                </div>
                <div class="col-md-8 no-padding col-xs-8">
                    <div class="boxtexto2">
                        <a href="<?= Url::to(['novedad/' . $item['idnoticia']]) ?>">
                            <span class="text-aileronsb13" style="color: #0a0a0a"><?= $item['titulo'] ?></span></a><br>
                        <span class="text-aileronsb13"
                              style="color: #0a0a0a"><?= \yii\helpers\StringHelper::truncate($item['resumen'], 50) ?>
                            ..</span></a><br>


                    </div>
                </div>
                <div class="clearfix"></div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<br>
<a href="<?= Url::to(['novedades']) ?>" class="boton-vermas">Ver mas +</a>











