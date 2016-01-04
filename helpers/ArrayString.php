<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.16
 * Time: 18:24
 */

namespace helper;

use yii\helpers\Html;

class ArrayString {

    /*
    *TODO обварачивает каждый елемент масива в заданный Html
     */
    /**
     * @param $tag
     * @param $inputArray
     * @return string
     */
    public static function arrayToHtmlStr($tag, $inputArray)
    {
        $outputArray = [];

        foreach ($inputArray as $element) {
            $outputArray[] = Html::tag($tag, $element);
        }

        return implode('', $outputArray);
    }
}