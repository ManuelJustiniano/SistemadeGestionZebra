<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = 'main';
    //public $basePath = '@webroot/admin/';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->set('user', [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Administrador',
            'loginUrl' => ['admin/default/login'],
            //'identityCookie' => ['name' => 'admin_mym', 'httpOnly' => true],
            'idParam' => 'admin_id', //this is important !
        ]);
    }
}
