<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.01.16
 * Time: 11:09
 */

namespace common\components;


use yii\base\Component;
use yii\helpers\Html;

class ArrayToHtmlStr extends Component {

    public static function convert($HtmlTag , array $inputArray)
    {
        $array = [];
        foreach ($inputArray as $element) {
            $array[] = Html::tag($HtmlTag, Html::encode($element));
        }
        $a = implode('', $array);
        return $a;
    }

}