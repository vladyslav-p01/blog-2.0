<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    public $category_id;//integer; search by category id
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id_post', 'created_at', 'updated_at', 'author_id', 'deleted'], 'integer'],
            [['title', 'body'], 'string'],
            ['category_id', 'integer'],
        ];
    }






    /**
     * @inheritdoc
     */
    /*public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }*/

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('categories');

        $query->andFilterWhere([
            'post.deleted' => false,
            'id_category' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body]);
        return $dataProvider;
    }
}
