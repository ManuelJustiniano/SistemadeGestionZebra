<?php
use yii\helpers\Url;
use yii\widgets\Menu;
$user = Yii::$app->session->get('user');

if ($user->tipo_usuario == '1') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Inicio', 'url' => ['/administrador/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mi cuenta', 'url' => ['/administrador/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Recursos', 'url' => ['/recursos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mensajes', 'url' => ['/administrador/mensajes'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Usuarios', 'url' => ['/administrador/usuarioslist'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'administrador',
    ]);
} elseif ($user->tipo_usuario == '2') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Inicio', 'url' => ['/gestor/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mi cuenta', 'url' => ['/gestor/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mensajes', 'url' => ['/gestor/mensajes'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'gestor',
    ]);
}
elseif ($user->tipo_usuario == '3') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Inicio', 'url' => ['/consultor/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mi cuenta', 'url' => ['/consultor/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mis proyectos', 'url' => ['/proyectos/listaproyectos'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mensajes', 'url' => ['/consultor/mensajes'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'consultor',
    ]);
}

elseif ($user->tipo_usuario == '4') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Inicio', 'url' => ['/cliente/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mi cuenta', 'url' => ['/cliente/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mis proyectos', 'url' => ['/proyectos/listaproyectos'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mensajes', 'url' => ['/clientes/mensajes'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'cliente',
    ]);
}
?>