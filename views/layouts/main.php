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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?= \yii\helpers\Url::to('@web/assets_b/images/icon.jpg') ?>"/>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <body class="app">
    <?php //foreach (Yii::$app->session->getAllFlashes() as $message): ?>


            <?= $content ?>

    <footer class="app-footer">
        <div class="container text-center py-3">
            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">   Zebra Brand Consulting. &copy; 2025. - Derechos Reservados</small>

        </div>
    </footer><!--//app-footer-->
    <style>
        .form-group.has-error .help-block {
            font-size: 1.4rem;
            display: none;
        }
    </style>



    <?php $this->endBody() ?>



    </body>
    </html>
<?php $this->endPage() ?>