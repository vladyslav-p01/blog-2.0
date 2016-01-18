<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.01.16
 * Time: 11:09
 */

namespace common\components;


use common\models\Comment;
use yii\base\Component;
use yii\grid\ActionColumn;
use yii\helpers\Html;

class ArrayToHtmlStr extends Component {

    public static function convert($HtmlTag , array $inputArray)
    {
        $array = [];
        foreach ($inputArray as $element) {
            $array[] = Html::tag($HtmlTag, $element);
        }
        $a = implode('', $array);
        return $a;
    }

    public static function convertWithActions($outerTag, $innerTag, array $comments, $outerOptions = [], $innerOptions = [])
    {
        $array = [];
        foreach ($comments as $comment) {
            /* @var Comment $comment */
            $string = Html::tag($innerTag, $comment->body, $innerOptions);// only comment in Html

            $string .= 'Author: '.  Html::a(
                $comment->author->username,
                ['user/view', 'id' => $comment->author->id]
                );
            $string .= ' ' . Html::a('edit',
                    ['comment/update', 'id' => $comment->id_comment]);
            $string .= ' ' . Html::a('delete',
                    ['comment/delete', 'id' => $comment->id_comment], [
                        'data' => [
                            'method' => 'post',
                            'confirm' => 'Are you sure you want to delete this item'
                        ]
                    ]);
            $array[] = Html::tag($outerTag, $string, $outerOptions);

        }
        $a = implode('', $array);
        return $a;
    }

}