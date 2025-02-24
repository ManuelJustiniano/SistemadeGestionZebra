<?php

$script = <<<CSS
CSS;
$this->registerCss($script);
$menu = new \app\models\Categoria();
$configuracion = \app\models\Configuracion::find()->one();


\app\assets_b\AppAsset::register($this);


?>

<?= $this->render('banners/fijo', ['titulo' => 'Productos']) ?>








                <?php
                if (isset($all)) {
                    echo $this->render('productos/lista', ['model' => $model->getModels(), 'data' => $model]);
                    echo $this->render('../widgets/metatags', ['model' => $configuracion]);
                } else {
                    if (count($model) > 0)
                        echo $this->render('productos/item', ['model' => $model]);
                }
                ?>




