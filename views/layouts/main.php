<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets_b\AppAsset;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

AppAsset::register($this);
$script = <<<CSS
CSS;
$this->registerCss($script);

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
        <link rel="shortcut icon" type="image/png" href="<?= \yii\helpers\Url::to('@web/assets_b/images/icon.png') ?>"/>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?php if (Yii::$app->session->hasFlash('mensaje')): ?>
        <div class="alert alert-<?= Yii::$app->session->getFlash('mensaje')['type'] ?>">
            <?= Yii::$app->session->getFlash('mensaje')['message'] ?>
        </div>
    <?php endif; ?>


    <div class="page-wrapper">
        <header class="header">

            <div class="header-middle">
                <div class="container">

                    <div class="header-left clogo">
                        <a href="<?= Url::home() ?>" class="logo">
                            <img src="<?= Url::to(['assets_b/images/logo.png']) ?>" alt="PARTY GLOBOSO"
                                 title="Proyecto Diseño Software">


                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <a href="" target="_blank"></a>
                        <div class="header-bottom sticky-header">
                            <div class="container">
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
                                            ['label' => 'EMPRESA', 'url' => ['/site/empresa'], 'options' => ['class' => ''],],
                                            ['label' => 'MODELOS', 'url' => ['/site/modelos'], 'options' => ['class' => ''],],
                                            ['label' => 'CONTACTO', 'url' => ['/site/contacto'], 'options' => ['class' => ''],],

                                        ],
                                    ]);
                                    ?>


                                </nav>
                            </div><!-- End .header-bottom -->
                        </div><!-- End .header-bottom -->


                    </div><!-- End .header-right -->


                </div><!-- End .headeer-center -->
            </div><!-- End .headeer-center -->



        </header><!-- End .header -->


        <?//= $this->render('modals/login') ?>
        <?//= $this->render('modals/registro') ?>


        <!--container-main-->
        <main class="main">
            <?= $content ?>
        </main><!-- End .main -->
        <!--/container-main-->


        <footer class="footer">

            <div class="container">
                <div class="footer-bottom">
                    <p class="footer-copyright">PROYECTO DISEÑO SOFTWARE. &copy; 2024 - Desarrollado por - Jose Manuel Justiniano Rios</p>


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


                        'items' => [

                            ['label' => 'INICIO', 'url' => ['/site/index'], 'options' => ['class' => ''],],
                            ['label' => 'EMPRESA', 'url' => ['/site/empresa'], 'options' => ['class' => ''],],
                            ['label' => 'MODELOS', 'url' => ['/site/modelos'], 'options' => ['class' => ''],],
                            ['label' => 'CONTACTO', 'url' => ['/site/contacto'], 'options' => ['class' => ''],],

                        ],

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