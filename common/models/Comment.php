<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id_comment
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $author_id
 * @property integer $post_id
 *
 * @property User $author
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'required'],
            [['body'], 'string'],
            ['post_id', 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'Id Comment',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'author_id' => 'Author ID',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function save($runValidation = true, $attributeNames = [])
    {
        if ($this->isNewRecord) {
            $this->created_at = time();
        } else {
            $this->updated_at = time();
        }

        $this->author_id = Yii::$app->user->id;

        return parent::save() ? true : false;

    }
}
