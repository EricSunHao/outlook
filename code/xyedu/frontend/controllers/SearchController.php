<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\SearchHistory;
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
class SearchController extends Controller
{
    public $added = 0;
    public $layout = '/search';
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
        $tags = Tag::findHotTags(8);
        $keyword = SearchHistory::findSearchHistory(5);
        return $this->render('index',['tags' => $tags,'keyword' => $keyword]);
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
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetail()
    {
        $searchModel = new Post();
        $searchInput = Yii::$app->request->get('keywords');
        if (empty($searchInput)) $this->redirect(['index']);
        $params = trim($searchInput);

        //增加用户搜索历史信息
        $history = new SearchHistory();
        $history->uid = Yii::$app->user->id;
        $history->keyword = $params;
        $history->save();

        //查看类似搜索关键词
        $keywords = SearchHistory::findSameKeyword($params);

        $dataProvider = $searchModel->searchMany($params);
        $searchCount = $dataProvider->getTotalCount();

        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchCount' => $searchCount,
            'searchInput' => $searchInput,
            'keywords' => $keywords,
        ]);

    }
}
