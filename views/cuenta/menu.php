<?php
use kartik\widgets\SideNav;
echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'heading' => 'Menu',
    'items' => [
        [
            'url' => ['cuenta/datos'],
            'label' => 'Datos de la cuenta',
            'icon' => 'user'
        ],
        /*[
            'url' => ['cuenta/deseos'],
            'label' => 'Lista de Deseos',
            'icon' => 'heart'
        ],*/
        [
            'url' => ['cuenta/usuarios'],
            'label' => 'Lista de usuarios',
            'icon' => 'list'
        ],
        [
            'url' => ['cuenta/tipousuarios'],
            'label' => 'Tipo de usuarios',
            'icon' => 'list'
        ],
        [
            'url' => ['cuenta/trabajos'],
            'label' => 'Tipo de usuarios',
            'icon' => 'list'
        ],

    ],
]);
