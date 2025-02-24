<?php

$menu = new \app\models\Categoria();
$script = <<<CSS

CSS;
$this->registerCss($script);

$configuracion = \app\models\Configuracion::find()->one();
//$this->render('../widgets/metatags', ['model' => $configuracion]);


\app\assets_b\AppAsset::register($this);


?>





                    <?php
                    if (isset($all)) {
                        echo $this->render('noticias/lista', ['model' => $model->getModels(), 'data' => $model]);
                        $this->render('../widgets/metatags', ['model' => $configuracion]);
                    } else {
                        if (count($model) > 0)
                            echo $this->render('noticias/item', ['model' => $model]);
                    }
                    ?>



