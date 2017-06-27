<?php
namespace app\modules\api;

use yii\base\BootstrapInterface;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function init()
    {
        parent::init();
        if (\Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            [
                'class' => 'yii\rest\UrlRule',
            ]
        ]);
    }
} 