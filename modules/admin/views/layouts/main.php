<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;

\app\assets_b\AssetAdmin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>


    <link rel="stylesheet" href="../../assets_b/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets_b/css/font-awesome.min.css">
</head>
<body class="hold-transition skin-red sidebar-mini">


<style>
    .skin-red .main-header .navbar,
    .skin-red .main-header .logo{
        background-color: #2196f3!important;
    }

    .skin-red .sidebar-menu>li:hover>a, .skin-red .sidebar-menu>li.active>a {
        color: #fff;
        background: #2196f3;
        border-left-color: #000000;
    }

    .skin-red .sidebar-menu>li.header {
        color: #4b646f;
        background: #8dccff;
    }

    .skin-red .wrapper, .skin-red .main-sidebar, .skin-red .left-side {
        background-color: #ffffff;
    }


    .navbar-nav>.user-menu>.dropdown-menu>.user-footer {
        background-color: #2196f3;
        padding: 10px;
    }
    .navbar-nav>.user-menu>.dropdown-menu>.user-footer .btn-default {
        color: #ffffff;
        background: transparent;
        border: none;
        font-size: 16px;
        font-weight: 600;
    }

</style>
<?php $this->beginBody() ?>

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Sistema</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="    background: transparent;
    color: white;
    margin-top: ">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?= Yii::$app->user->identity->usuario ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->


                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="<?= \yii\helpers\Url::to(['default/logout']) ?>"
                                       class="btn btn-default btn-flat">Salir</a>
                                </div>

                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) --
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="http://placehold.it/45x45" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Marca&amp;Mercado</p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <?php
            $items = [
                ['label' => 'MENU', 'options' => ['class' => 'header']],
                ['label' => 'Inicio', "url" => ['default/index'], "icon" => "home"],
            ];
            $modulos = \app\models\Modulos::findAll(['estado' => '1']);
            foreach ($modulos as $modulo) {
                array_push($items, ["label" => $modulo->nombre, "url" => [$modulo->alias . '/index'], "icon" => $modulo->icono]);
            }
            ?>
            <?=
            \dmstr\widgets\Menu::widget([
                "items" => $items,/*[
                    //["label" => "Home", "url" => \yii\helpers\Url::home(), "icon" => "home"],
                    //["label" => "Productos", "url" => ['productos/index'], "icon" => "list"],
                    //["label" => "Categorias", "url" => ['categoria/index'], "icon" => "list"],
                    //["label" => "Banner", "url" => ['banner/index'], "icon" => "picture-o"],
                    //["label" => "Promociones", "url" => ['promociones/index'], "icon" => "user-plus"],
                    //["label" => "Tiendas", "url" => ['tiendas/index'], "icon" => "shopping-cart "],
                    //["label" => "Noticias", "url" => ['noticias/index'], "icon" => "newspaper-o"],
                    //["label" => "Contenido", "url" => ['contenido/index'], "icon" => "file-text-o"],
                    //["label" => "Clientes", "url" => ['clientes/index'], "icon" => "users"],
                    //["label" => "Archivos", "url" => ['archivos/index'], "icon" => "folder-open"],
                    //["label" => "Galerias", "url" => ['galeria/index'], "icon" => "picture-o"],
                    //["label" => "Videos", "url" => ['videos/index'], "icon" => "video-camera"],
                    //["label" => "Usuarios", "url" => ['usuarios/index'], "icon" => "user"],
                ],*/
                'options' => ['class' => 'sidebar-menu']
            ])
            ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Main content -->
    <div class="content-wrapper">
        <?= $content ?>
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo Yii::$app->params['version'] ?>
    </div>
    <strong>Copyright &copy; <?= date("Y") ?> </strong> All
    rights
    reserved.
</footer>

</div><!-- ./wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
