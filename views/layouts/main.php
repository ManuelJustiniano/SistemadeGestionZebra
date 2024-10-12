<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\assets_b\AppAsset;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

AppAsset::register($this);

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
    <?php //foreach (Yii::$app->session->getAllFlashes() as $message): ?>


    <div class="page-wrapper">
        <header class="header">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left clogo">
                        <a href="<?= Url::home() ?>" class="logo">
                            <img src="<?= Url::to(['assets_b/images/logo.png']) ?>" alt="ZEBRA BRAND CONSULTING"
                                 title="ZEBRA BRAND CONSULTING">
                        </a>
                    </div><!-- End .header-left -->
                    <div class="header-center header-bottom ">
                        <nav class="main-nav">

                            <?php

                            echo Menu::widget([
                                'options' => ['class' => 'menu sf-arrows',],
                                'activeCssClass' => 'active',
                                'encodeLabels' => false,
                                'lastItemCssClass' => '',
                                'submenuTemplate' => "\n<ul  role=\"menu\" class=\"mega-menu\" id=\"menu\" >\n{items}\n</ul>\n",

                                'items' => [

                                    ['label' => 'INICIO', 'url' => ['/site/index'], 'options' => ['class' => ''],],


                                    ['label' => 'Quienes Somos', 'url' => ['/site/nosotros'], 'options' => ['class' => ''],],


                                    ['label' => 'Noticias', 'url' => ['/site/noticias'], 'options' => ['class' => ''],],
                                    ['label' => 'Contácto', 'url' => ['/site/contacto'], 'options' => ['class' => ''],],

                                ],
                            ]);
                            ?>
                        </nav>
                    </div><!-- End .header-search -->
                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <span>Teléfono</span>
                            <a href="tel:#"><strong><?php echo $conf['telefono_empresa'] ?></strong></a>
                        </div><!-- End .header-contact -->

                    </div><!-- End .header-right -->
                </div><!-- End .headeer-center -->
            </div><!-- End .headeer-center -->
            <a href="" target="_blank"></a>
        </header><!-- End .header -->
        <!--container-main-->
        <main class="main">
            <?= $content ?>
        </main><!-- End .main -->
        <!--/container-main-->
        <footer class="footer">
            <div class="container">
                <div class="footer-bottom">
                    <p class="footer-copyright">Zebra Brand Consulting. &copy; 2025. - Derechos Reservados </p>
                    <div class="social-icons">
                    </div><!-- End .social-icons -->
                </div><!-- End .footer-bottom -->
            </div><!-- End .containr -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
            <nav class="mobile-nav">
                <?php

                echo Menu::widget([
                    'options' => ['class' => 'mobile-menu',],
                    'activeCssClass' => 'active',
                    'encodeLabels' => false,
                    'lastItemCssClass' => '',
                    'submenuTemplate' => "\n<ul  role=\"menu\" class=\"mega-menu\" id=\"menu\" >\n{items}\n</ul>\n",

                    'items' => [

                        ['label' => 'Inicio', 'url' => ['/site/index'], 'options' => ['class' => ''],],
                        ['label' => 'Quienes Somos', 'url' => ['/site/nosotros'], 'options' => ['class' => ''],],

                        ['label' => 'Noticias', 'url' => ['/site/noticias'], 'options' => ['class' => ''],],
                        ['label' => 'Contácto', 'url' => ['/site/contacto'], 'options' => ['class' => ''],],

                    ],
                ]);
                ?>
            </nav><!-- End .mobile-nav -->
        </div><!-- End .mobile-menu-wrapper -->
    </div>
    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <?php $this->endBody() ?>


    </body>
    </html>
<?php $this->endPage() ?>