<?php
namespace backend\controllers;

use common\models\Comment;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Category;
use common\models\User;
use common\models\Post;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $usersQuantity = count(User::getAllUsers());
        $categories = Category::getAllCategories();

        //categoryQuantity = [array(categoryName, quantityPostsInCategory)]
        $categoriesQuantity = [];
        foreach ($categories as $category) {
            $categoriesQuantity[] = array($category->name, count($category->categoryPosts));
        }

        return $this->render('index',
            [
                'usersQuantity' => $usersQuantity,
                'categoriesQuantity' => $categoriesQuantity,
                'commentsQuantity' => count(Comment::find()->all()),
                'postsQuantity' => count(Post::find()->all())
            ]
        );
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login2', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
