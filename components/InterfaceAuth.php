<?php
namespace app\components;

interface InterfaceAuth
{
    public function login($model);
    public function logout();
}