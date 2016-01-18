<?php

namespace backend\controllers;

use common\components\ConfirmAccess;
use Yii;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        //if (Yii::$app->user->can())

        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       ConfirmAccess::check('createCategory');

        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        ConfirmAccess::check('updateCategory');

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        ConfirmAccess::check('deleteCategory');

        $category = $this->findModel($id);

        $category->deleted = 1;
        foreach ($category->categoryPosts as $post) {
            /* @var $post \common\models\Post  */
            $post->deleted = 1;
            $post->save(false);
        }
        $category->save();

        return $this->redirect(['index']);
    }

    public function actionDeleteHard($id)
    {
        ConfirmAccess::check('deleteHardCategory');
        $category = $this->findModel($id);


        if (count($posts = $category->categoryPosts) != 0) {
            foreach ($posts as $post) {
                /* @var $post \common\models\Post*/

                $post->unlink('categories', $category, true);

                if (count($postCategories = $post->categories) == 0) {
                    $post->delete();
                }
            }
        }
        $category->delete();
        return $this->redirect(['index']);
    }

    public function actionUndoDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = 0;
        if (count($posts = $model->categoryPosts) != 0) {
            foreach ($posts as $post) {
                /* @var $post \common\models\Post */
                $post->deleted = 0;
                $post->save(false);
            }
        }
        $model->save();
        return $this->redirect(['view', 'id' => $model->id_category]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
