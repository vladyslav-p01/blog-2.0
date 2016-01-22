<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.01.16
 * Time: 11:09
 */

namespace common\components;


use yii\base\Component;
use yii\web\NotFoundHttpException;
use Yii;

class ConfirmAccess extends Component {

    public static function check($accessName, $params = [])
    {
        if (!Yii::$app->authManager->getPermission($accessName)) {
            throw new NotFoundHttpException('Such permission does not exist');
        }
        if (!Yii::$app->user->can($accessName, $params)) {
            throw new NotFoundHttpException('Access denied');
        }
    }

}