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

    public static function check($accessName)
    {
//        if (!Yii::$app->user->can($accessName)) {
//            throw new NotFoundHttpException('Access denied');
//        }
    }

}