<?php

namespace backend\controllers;

use common\components\ConfirmAccess;
use common\models\Category;
use Yii;
use common\models\Post;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PostSearch;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public $layout = 'admin';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {


        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);

        return $this->render('index', [
            'categories' => Category::find()->all(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'categories' => $this->getCategories()
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        ConfirmAccess::check('createPost');

        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->linkRelations();
            return $this->redirect(['view', 'id' => $model->id_post]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $this->getCategories()
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        ConfirmAccess::check('updatePost');

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->unlinkAll('categories', true);
            $model->linkRelations();
            return $this->redirect(['view', 'id' => $model->id_post]);
        } else {

            $model->categories_ids = ArrayHelper::getColumn($model->categories, 'id_category');
            return $this->render('update', [
                'model' => $model,
                'categories' => $this->getCategories()
            ]);
        }
    }

    public function actionDelete($id)
    {

        ConfirmAccess::check('deletePost');

        $model = $this->findModel($id);

        $model->deleted = 1;
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteHard($id)
    {
        ConfirmAccess::check('deleteHardPost');

        $model = $this->findModel($id);

        $model->unlinkAll('categories', true);
        if (count($comments = $model->comments)) {
            foreach ($comments as $comment) {
                /* @var $comment \common\models\Comment*/
                $comment->delete();
            }
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionUndoDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = 0;
        $model->save(false);
        return $this->redirect(['view', 'id' => $model->id_post]);
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getCategories()
    {
        return ArrayHelper::map(Category::find()->all(), 'id_category', 'name');
    }
}
