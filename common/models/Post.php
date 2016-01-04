<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id_post
 * @property string $title
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $author_id
 * @property integer $deleted
 *
 * @property $categories // read only
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
    public $categories_ids; // writable property for categories
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 30],
            ['categories_ids', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'author_id' => 'Author ID',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id_category' => 'category_id'])
            ->viaTable('category_post', ['post_id' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {

        if ($this->getIsNewRecord()) {
            $this->created_at = time();
        } else {
            $this->updated_at = time();
        }

        $this->author_id = Yii::$app->user->identity->getId();
        return parent::save($runValidation, $attributeNames) ? true : false;
    }

    public function linkRelations()
    {
        foreach ($this->categories_ids as $categoryId) {
            $category = Category::findOne($categoryId);
            $this->link('categories', $category);
        }
    }

    public function delete()
    {
        $this->deleted = true;
        $this->save();
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id_post']);
    }
}
