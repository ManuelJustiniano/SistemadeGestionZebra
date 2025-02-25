<?php

use kartik\sidenav\SideNav;
use yii\helpers\Url;

$conf = \app\models\Configuracion::find()->one();
\app\assets_b\AppAsset::register($this);


$script = <<<CSS
.kv-sidenav li a {
    border-radius: 0;
       border-bottom: 1px solid #ddd;
}

.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 0px solid transparent;
    border-radius: 0px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 0px 0px rgba(0, 0, 0, .05);
}

.nav.nav-pills.nav-stacked.kv-sidenav a:hover,
.nav.nav-pills.nav-stacked.kv-sidenav a:focus,
.nav.nav-pills.nav-stacked.kv-sidenav a:active
{
    background-color: #fff;
}
.nav.nav-pills.nav-stacked.kv-sidenav a{
padding: 10px 0px!important;
font-size: 1.45rem;
}
.nav.nav-pills.nav-stacked.kv-sidenav{
    display: block!important;
}

.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #000;
    background-color: #ffffff;
    font-weight: 600;
}



CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);


?>

<?php
//$ip = new \app\models\Categoria();
//$cats = $ip->getMenu3('noticias');
$cat = \app\models\Categoria::findOne(['alias' => 'productos']);
$cats = $cat->categorias;


?>


<?php   $items = [];
foreach ($cats as $item) {



    $sub = $item->categorias;
    if (count($sub) > 0) {
        $values = [];
        foreach ($sub as $value) {
            $sub2 = $value->categorias;


            if (count($sub2) > 0) {
                $tmp = [];
                foreach ($sub2 as $value2) {
                    array_push($tmp, ['label' => $value2['nombre'], 'icon' => '', 'url' => Url::to(['productos' . '?cat='  . $value2['idcategoria']]), 'active' => ($value2['idcategoria'] == Yii::$app->getRequest()->getQueryParam('cat'))]);
                }
                array_push($values, ['label' => $value['nombre'], 'icon' => '', 'items' => $tmp]);
            } else {
                array_push($values, ['label' => $value['nombre'], 'icon' => '', 'url' => Url::to(['productos'. '?cat=' .  $value['idcategoria']]), 'active' => ($value['idcategoria'] == Yii::$app->getRequest()->getQueryParam('cat'))]);
            }
        }
        array_push($items, ['label' => $item['nombre'], 'icon' => '', 'items' => $values]);
    } else {
        array_push($items, ['label' => $item['nombre'], 'icon' => '',  'url' => Url::to(['productos'.  '?cat=' .   $item['idcategoria']]), 'active' => ($item['idcategoria'] == Yii::$app->getRequest()->getQueryParam('cat')),]);

    }



}?>


<div class="collapse show" id="widget-body-2">
    <div class="widget-body">







    <?php
    echo "<div class=''>" . SideNav::widget([
            'encodeLabels' => false,
            'heading' => false,
            'items' => $items,
            'containerOptions' => ['class' => ''],

        ]) . "</div>";?>




</div><!-- End .widget-body -->
    </div><!-- End .collapse -->

