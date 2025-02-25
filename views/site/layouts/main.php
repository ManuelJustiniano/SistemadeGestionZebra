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


$model = new \app\models\ContactForm();
$data = new \app\models\Categoria();

AppAsset::register($this);
//$this->registerCssFile('@web/assets_b/web/css/font-awesome.min.css',['depends'=>AppAsset::class]);

$script = <<<CSS
.select2-container--krajee .select2-results__option--highlighted[aria-selected] {
    background-color: #f0c2df!important;}

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
    <?php //foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?php if (Yii::$app->session->hasFlash('mensaje')) : ?>
        <?php $message = Yii::$app->session->getFlash('mensaje'); ?>
        <?= \kartik\widgets\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            'body' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Menjase Desconocido!',
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 9000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ]
            ]
        ]); ?>
    <?php endif; ?>


    <div class="page-wrapper">


        <header class="header">
            <div class="header-top">
                <div class="container">


                    <div class="header-right">
                        <p class="welcome-msg">Bienvenidos a Party Globoso </p>

                        <div class="header-dropdown dropdown-expanded">
                            <a href="#">Menu</a>
                            <div class="header-menu">

                                <ul>
                                    <li><a href="<?php echo Url::to('site/nosotros') ?>">Quienes Somos</a></li>
                                    <li><a href="<?php echo Url::to('site/noticias') ?>">Noticias</a></li>
                                    <li><a href="<?php echo Url::to('site/contacto') ?>">Contacto </a></li>

                                </ul>


                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropown -->


                        <div class="social-icons">


                            <?php if ($conf['facebook']): ?>
                                <a href="<?php echo $conf['facebook'] ?>" class="social-icon" target="_blank"><i
                                            class="icon-facebook"></i></a>

                            <?php endif; ?>
                            <?php if ($conf['twitter']): ?>
                                <a href="<?php echo $conf['twitter'] ?>" class="social-icon" target="_blank"><i
                                            class="icon-twitter"></i></a>

                            <?php endif; ?>

                            <?php if ($conf['instagram']): ?>
                                <a href="<?php echo $conf['instagram'] ?>" class="social-icon" target="_blank"><i
                                            class="icon-instagram"></i></a>

                            <?php endif; ?>

                        </div><!-- End .social-icons -->


                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->


            <div class="header-middle">
                <div class="container">


                    <div class="header-left clogo">
                        <a href="<?= Url::home() ?>" class="logo">
                            <img src="<?= Url::to(['assets_b/images/logo.jpg']) ?>" alt="PARTY GLOBOSO"
                                 title="PARTY  GLOBOSO">


                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search">


                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>

                            <?php $form = ActiveForm::begin(['id' => 'frmContact', 'options' => ['class' => 'search-form top-spacing5'], 'action' => ['site/productos'], 'method' => 'get']); ?>


                            <?php
                            $format = <<< SCRIPT
function format(state) {
if (!state.id) return state.text; // optgroup
return state.text;
}
SCRIPT;
                            $escape = new \yii\web\JsExpression("function(m) { return m; }");
                            $this->registerJs($format, \yii\web\View::POS_HEAD);
                            ?>
                            <div class="header-search-wrapper">


                                <input type="text" class="form-control" name="s" id="q"
                                       placeholder="Titulo del producto..." required>

                                <div class="select-custom">
                                    <?php

                                    echo Select2::widget([
                                        'name' => 'cat',
                                        'data' => $data->getSelectMenu('productos'),
                                        'options' => ['placeholder' => 'Categoria'],
                                        'pluginOptions' => [
                                            'templateResult' => new \yii\web\JsExpression('format'),
                                            'templateSelection' => new \yii\web\JsExpression('format'),
                                            'escapeMarkup' => $escape,
                                            'allowClear' => true
                                        ],
                                    ]); ?>

                                </div>

                                <button class="btn" type="submit"><i class="icon-magnifier"></i></button>

                            </div><!-- End .select-custom -->

                            <?php ActiveForm::end(); ?>
                        </div><!-- End .header-search-wrapper -->


                    </div><!-- End .header-search -->


                    <div class="header-right">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <div class="header-contact">
                            <span>Teléfono</span>
                            <a href="tel:#"><strong><?php echo $conf['telefono_empresa'] ?></strong></a>
                        </div><!-- End .header-contact -->

                        <div class="dropdown cart-dropdown">
                            <a href="<?= Url::to(['carrito/index']) ?>" class="dropdown-toggle">
                                <span class="cart-count"><?= \Yii::$app->cart->getCount() ?></span>

                                <span><?= \Yii::$app->cart->getCost() ?> Bs. </span>

                                <span style="    display: block;
    text-align: center;
    text-align: center;
    font-size: 10px;"> Ver carrito</span>
                            </a>

                        </div><!-- End .dropdown -->


                    </div><!-- End .header-right -->


                </div><!-- End .headeer-center -->
            </div><!-- End .headeer-center -->


            <a href="" target="_blank"></a>


            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav">

                        <?php

                        $categoria = \app\models\Categoria::findOne(['alias' => 'productos']);
                        $cats = $categoria->categorias;
                        $items_p = [];

                        foreach ($cats as $item) {

                            // array_push($items_p, ['label' => $item['nombre'], 'url' => Url::to([$categoria['alias'] .  '?cat=' .   $item['idcategoria']]), 'active' => ($item['idcategoria'] == Yii::$app->getRequest()->getQueryParam('cat')),]);
                            array_push($items_p, ['label' => $item['nombre'], 'url' => Url::to(['site/productos', 'cat' => $item['idcategoria']]), 'active' => ($item['idcategoria'] == Yii::$app->getRequest()->getQueryParam('id')),]);


                            // array_push($items_p, ['label' => $item['nombre'], 'url' => ['/site/noticias', 'alias' => $item['alias'] , 'cat' => $item['idcategoria']],  'options' => ['class' => ''],]);
                        }  // array_push($items_p, ['label' => $item['nombre'], 'url' => ['/site/noticias', 'alias' => $item['alias'] , 'cat' => $item['idcategoria']],  'options' => ['class' => ''],]);


                        echo Menu::widget([
                            'options' => ['class' => 'menu sf-arrows',],
                            'activeCssClass' => 'active',
                            'encodeLabels' => false,
                            'lastItemCssClass' => '',
                            'submenuTemplate' => "\n<ul  role=\"menu\" class=\"mega-menu\" id=\"menu\" >\n{items}\n</ul>\n",

                            'items' => [

                                ['label' => 'Inicio', 'url' => ['/site/index'], 'options' => ['class' => ''],],
                                ['label' => 'Quienes Somos', 'url' => ['/site/nosotros'], 'options' => ['class' => ''],],
                                ['label' => 'Productos', 'template' => '<a href="{url}"  class="sf-with-ul" >{label}</a>', 'options' => ['class' => ''], 'url' => '#', 'items' => $items_p],

                                ['label' => 'Noticias', 'url' => ['/site/noticias'], 'options' => ['class' => ''],],
                                ['label' => 'Contácto', 'url' => ['/site/contacto'], 'options' => ['class' => ''],],

                            ],
                        ]);
                        ?>


                    </nav>
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->


        <?= $this->render('modals/login') ?>
        <?= $this->render('modals/registro') ?>


        <!--container-main-->
        <main class="main">
            <?= $content ?>
        </main><!-- End .main -->
        <!--/container-main-->


        <footer class="footer">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-4">
                            <div class="widget">
                                <h4 class="widget-title">Nosotros</h4>

                                <p>
                                    Somos una empresa dedicada a la importación de artículos de cotillón y juguetes, con
                                    un servicio de distribución por mayor y por menor en varias ciudades del país,
                                    ofrecemos una bonita experiencia a la hora de organizar un evento
                                </p>


                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-2 -->

                        <div class="col-lg-2 col-md-4">
                            <div class="widget">
                                <h4 class="widget-title">Menú</h4>

                                <ul class="links">
                                    <li><a href="<?= Url::to(['site/index']) ?>">Inicio</a></li>
                                    <li><a href="<?= Url::to(['site/nosotros']) ?>">Quienes Somos</a></li>
                                    <li><a href="<?= Url::to(['site/productos']) ?>">Productos</a></li>
                                    <li><a href="<?= Url::to(['site/noticias']) ?>">Noticias</a></li>
                                    <li><a href="<?= Url::to(['site/contacto']) ?>">Contacto</a></li>
                                </ul>
                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-2 -->

                        <div class="col-lg-3 col-md-4">
                            <div class="widget">
                                <h4 class="widget-title">Últimas noticias</h4>
                                <?php $noticiasfoter = \app\models\Noticias::find()->where(['estado' => '1', 'destacado' => '1'])->orderBy(['idnoticia' => SORT_DESC])->limit('5')->all() ?>


                                <ul class="links">
                                    <?php foreach ($noticiasfoter

                                                   as $item): ?>

                                        <li>

                                            <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>"
                                               class="text-montbold14 text-blue">
                                                <?= \yii\helpers\StringHelper::truncate($item['titulo'], 65) ?>
                                            </a>


                                        </li>

                                    <?php endforeach; ?>

                                </ul>


                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-3 -->


                        <div class="col-lg-4 col-md-4">
                            <div class="widget">
                                <ul class="contact-info">
                                    <li>
                                        <span class="contact-info-label">Dirección:</span><?php echo $conf['direccion_empresa'] ?>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Teléfono(s):</span><a
                                                href="tel:"><?php echo $conf['telefono_empresa'] ?></a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Email:</span> <a
                                                href="<?php echo $conf['email_web'] ?>"><?php echo $conf['email_web'] ?></a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Horarios :</span>
                                        <?php echo $conf['horarios'] ?>
                                    </li>
                                </ul>
                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            <div class="container">
                <div class="footer-bottom">
                    <p class="footer-copyright">Party Globoso. &copy; 2020. - Desarrollado por <a
                                href="https://marcaymercado.com/" target="_blank">Marca y Mercado</a></p>

                    <div class="social-icons">
                        <?php if ($conf['facebook']): ?>
                            <a href="<?php echo $conf['facebook'] ?>" class="social-icon" target="_blank"><i
                                        class="icon-facebook"></i></a>

                        <?php endif; ?>
                        <?php if ($conf['twitter']): ?>
                            <a href="<?php echo $conf['twitter'] ?>" class="social-icon" target="_blank"><i
                                        class="icon-twitter"></i></a>

                        <?php endif; ?>

                        <?php if ($conf['instagram']): ?>
                            <a href="<?php echo $conf['instagram'] ?>" class="social-icon" target="_blank"><i
                                        class="icon-instagram"></i></a>

                        <?php endif; ?>
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

                $categoria = \app\models\Categoria::findOne(['alias' => 'productos']);
                $cats = $categoria->categorias;
                $items_p = [];

                foreach ($cats as $item) {

                    // array_push($items_p, ['label' => $item['nombre'], 'url' => Url::to([$categoria['alias'] .  '?cat=' .   $item['idcategoria']]), 'active' => ($item['idcategoria'] == Yii::$app->getRequest()->getQueryParam('cat')),]);
                    array_push($items_p, ['label' => $item['nombre'], 'url' => Url::to(['productos', 'cat' => $item['idcategoria']]), 'active' => ($item['idcategoria'] == Yii::$app->getRequest()->getQueryParam('id')),]);


                    // array_push($items_p, ['label' => $item['nombre'], 'url' => ['/site/noticias', 'alias' => $item['alias'] , 'cat' => $item['idcategoria']],  'options' => ['class' => ''],]);
                }  // array_push($items_p, ['label' => $item['nombre'], 'url' => ['/site/noticias', 'alias' => $item['alias'] , 'cat' => $item['idcategoria']],  'options' => ['class' => ''],]);


                echo Menu::widget([
                    'options' => ['class' => 'mobile-menu',],
                    'activeCssClass' => 'active',
                    'encodeLabels' => false,
                    'lastItemCssClass' => '',
                    'submenuTemplate' => "\n<ul  role=\"menu\" class=\"mega-menu\" id=\"menu\" >\n{items}\n</ul>\n",

                    'items' => [

                        ['label' => 'Inicio', 'url' => ['/site/index'], 'options' => ['class' => ''],],
                        ['label' => 'Quienes Somos', 'url' => ['/site/nosotros'], 'options' => ['class' => ''],],
                        ['label' => 'Productos', 'template' => '<a href="{url}"  class="sf-with-ul" >{label}</a>', 'options' => ['class' => ''], 'url' => '#', 'items' => $items_p],

                        ['label' => 'Noticias', 'url' => ['/site/noticias'], 'options' => ['class' => ''],],
                        ['label' => 'Contácto', 'url' => ['/site/contacto'], 'options' => ['class' => ''],],

                    ],
                ]);
                ?>


            </nav><!-- End .mobile-nav -->

            <div class="social-icons">


                <?php if ($conf['facebook']): ?>
                    <a href="<?php echo $conf['facebook'] ?>" class="social-icon" target="_blank"><i
                                class="icon-facebook"></i></a>

                <?php endif; ?>
                <?php if ($conf['twitter']): ?>
                    <a href="<?php echo $conf['twitter'] ?>" class="social-icon" target="_blank"><i
                                class="icon-twitter"></i></a>

                <?php endif; ?>

                <?php if ($conf['instagram']): ?>
                    <a href="<?php echo $conf['instagram'] ?>" class="social-icon" target="_blank"><i
                                class="icon-instagram"></i></a>

                <?php endif; ?>

            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div>


    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <?php echo $this->render('../widgets/addCarrito'); ?>

    <?php $this->endBody() ?>


    </body>
    </html>
<?php $this->endPage() ?>