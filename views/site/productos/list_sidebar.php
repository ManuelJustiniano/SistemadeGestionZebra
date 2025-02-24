<?php

use yii\helpers\Url;
use Zelenin\yii\SemanticUI\modules\Rating;

?>
<?php if (isset($items)): ?>
    <ul id="lista2" style="list-style-type: none; padding-left: 0;">
        <?php foreach ($items as $key => $item): ?>
            <li>
                <div class="col-md-4 no-padding col-xs-4" style=" padding-left: 0;">
                    <?php if ($item['foto']): ?>
                        <img src="<?= Url::to($item['foto']) ?>" alt="Mejor Oferta" class="img-responsive">
                    <?php else: ?>
                        <img src="<?= Url::to('@web/assets_b/web/images/mejor-prom.png') ?>" alt="Mejor Oferta"
                             class="img-responsive">
                    <?php endif; ?>
                </div>
                <div class="col-md-8 no-padding col-xs-8">
                    <div class="boxtexto2">
                        <span class="text-aileronsb13"><?= $item['titulo'] ?></span><br>
                        <?php
                        echo Rating::widget([
                            'options' => [
                                'data' => [
                                    'rating' => 3,
                                    'max-rating' => 5
                                ]
                            ]
                        ]); ?>
                        <div class="text-ailerol13 text-center">

                            <?php
                            if ($item->promocion): ?>
                                <?php
                                $time = new \DateTime('now');
                                $today = $time->format('Ymd');
                                $tmp = date('Ymd', strtotime($item->promocion['fechafinal'])) ?>
                                <?php if ($tmp >= $today): ?>
                                    <span class="pull-left"><?= $item->promocion['precio'] ?>
                                        BS </span>&nbsp;&nbsp;-&nbsp;&nbsp;
                                    <span class="pull-right text-gray"><s><?= $item['precio'] ?>BS</s></span>
                                <?php endif; ?>
                            <?php else: ?>
                                -<span class="pull-left"><?= $item['precio'] ?>BS</span>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<br>
<a href="<?= Url::to(['productos']) ?>" class="boton-vermas">Ver mas +</a>
