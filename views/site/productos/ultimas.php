<?php
$categorias = \app\models\Categoria::getMenu($modulo);


use yii\helpers\Url;

?>

    <ul id="menu2" class="skin-minimal categoria">
        <?php foreach ($categorias as $item): ?>
            <?php $sub = $item->categorias; ?>
            <?php if (count($sub) > 0): ?>
                <li>
                    <a href="#inicio"><?= $item['nombre'] ?></a>

                    <ul>
                        <?php foreach ($sub as $value): ?>
                            <?php $sub2 = $value->categorias ?>
                            <?php if (count($sub2) > 0): ?>
                                <li>
                                    <a href="<?= Url::to($modulo . '?cat=' . $value['idcategoria']) ?>"><?= $value['nombre'] ?></a>
                                    <ul>
                                        <?php foreach ($sub2 as $value2): ?>
                                            <li>
                                                <a href="<?= Url::to($modulo . '?cat=' . $value2['idcategoria']) ?>"><?= $value2['nombre'] ?></a>
                                            </li>

                                        <?php endforeach; ?>
                                    </ul>

                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?= Url::to($modulo . '?cat=' . $value['idcategoria']) ?>"><?= $value['nombre'] ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?= Url::to($modulo . '?cat=' . $item['idcategoria']) ?>"><?= $item['nombre'] ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

<?php

$this->registerjsFile('@web/assets_b/web/plugin/acordeon/js/jquery-ui-effects.js', ['depends' => \app\assets_b\AppAsset::class, 'position' => \yii\web\View::POS_END]);
$this->registerjsFile('@web/assets_b/web/plugin/acordeon/js/ctmin.js', ['depends' => \app\assets_b\AppAsset::class, 'position' => \yii\web\View::POS_END]);
$this->registerjsFile('@web/assets_b/web/plugin/acordeon/js/shCore.js', ['depends' => \app\assets_b\AppAsset::class, 'position' => \yii\web\View::POS_END]);
$this->registerjsFile('@web/assets_b/web/plugin/acordeon/js/shBrushJScript.js', ['depends' => \app\assets_b\AppAsset::class, 'position' => \yii\web\View::POS_END]);

$script = <<<JS
 SyntaxHighlighter.all();

    $(document).ready(function() {

        $("#menu2").ctAccordion({
            easing: "easeOutBounce",
            speed: 1500
        });

    });
JS;
$this->registerJs($script, \yii\web\View::POS_END);









