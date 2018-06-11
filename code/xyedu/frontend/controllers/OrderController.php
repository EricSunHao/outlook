<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\Order;
use common\models\Tag;
use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * PostController implements the CRUD actions for Post model.
 */
class OrderController extends Controller
{
    public $added = 0;
    public $layout = '/public';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        return $this->render('index');
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetail()
    {
        $searchModel = new PostSearch();
        $searchInput = Yii::$app->request->get('keywords');
        $params['PostSearch']['tags'] = $searchInput;
        $params['PostSearch']['title'] = $searchInput;
//        $params['PostSearch']['content'] = $searchInput;
        $dataProvider = $searchModel->search($params);
        $searchCount = $dataProvider->getCount();

        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchCount' => $searchCount,
            'searchInput' => $searchInput,
        ]);

    }
}
