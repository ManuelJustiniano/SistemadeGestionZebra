<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\assets_b\AppAsset;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
AppAsset::register($this);
//\app\assets_b\AssetAdmin::register($this);
$conf = \app\models\Configuracion::find()->one();
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="es-ES">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <!--charset ?>">-->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?= \yii\helpers\Url::to('@web/assets_b/images/icon.jpg') ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <body class="app">
    <div class="wrapperesa">


            <?= $content ?>

    <footer class="app-footer">
        <div class="container text-center py-3">
            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">   Zebra Brand Consulting. &copy; 2025. - Derechos Reservados</small>

        </div>
    </footer><!--//app-footer-->


    </div>

    <?php $this->endBody() ?>



    </body>
    </html>
<?php $this->endPage() ?>