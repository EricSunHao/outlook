<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\Favorite;
use common\models\PostRecords;
use common\models\Tag;
use common\models\University;
use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public $added = 0;
    public $layout = '/public';
    public $enableCsrfValidation = false;
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
        $getParams = Yii::$app->request->post();
        if (empty($getParams) || empty($getParams['PostSearch']))
        {$category_id=1;}else{
            $category_id = $getParams['PostSearch']['category_id'];
        };
        //首次打开请求默认分类
        $queryParam = Yii::$app->request->queryParams;
        $queryParam['PostSearch']['category_id'] = $category_id;

        $category_type = Category::findOne($category_id)->type;
        $category = Category::findHotCategory();
        if ($category_type == Category::TYPE_POST){
            $searchModel = new PostSearch();
            $dataProvider = $searchModel->search($queryParam);
        }elseif($category_type == Category::TYPE_SCHOOL){
            $dataProvider = new ActiveDataProvider([
                'query'=>University::find()->where("status=1"),
                'sort'=>[
                    'defaultOrder'=>[
                        'ranking'=>SORT_ASC,
                    ],
                ],
                'pagination'=>['pageSize'=>10],
            ]);
        }elseif($category_type == Category::TYPE_HOSPITAL){
            $dataProvider = new ActiveDataProvider([
                'query'=>University::find()->where("status=2"),
                'sort'=>[
                    'defaultOrder'=>[
                        'ranking'=>SORT_ASC,
                    ],
                ],
                'pagination'=>['pageSize'=>10],
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category' => $category,
            'category_id' => $category_id,
            'category_type' => $category_type,
        ]);


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

    public function actionDetail($id)
    {
        //step1. 准备数据模型
        $model = $this->findModel($id);

        //缓存当前文章ID 为浏览记录作准备
        $cache = Yii::$app->cache;
        $next_post_id = $cache->get('next_post_id');
        if (!empty($next_post_id)) {
            //保存本条浏览记录
            if ($id !== $next_post_id ){
                $model->setReadHistory($next_post_id);
            }
        }
//        $tags=Tag::findTagWeights();
//        $recentComments=Comment::findRecentComments();
//
//        if (isset(Yii::$app->user->id)){
//            $userMe = User::findOne(Yii::$app->user->id);
//            $commentModel = new Comment();
//            $commentModel->email = $userMe->email;
//            $commentModel->userid = $userMe->id;
//
//            //step2. 当评论提交时，处理评论
//            if($commentModel->load(Yii::$app->request->post()))
//            {
//                $commentModel->status = 1; //新评论默认状态为 pending
//                $commentModel->post_id = $id;
//                if($commentModel->save())
//                {
//                    $this->added=1;
//                }
//            }
//        }else{
//            $commentModel = '';
//        }
        $cacheData = $id;
        $cache->set('next_post_id', $cacheData);
//        $sameQuery = $model->samePost();
        $sameQuery = $model->getReadHistory();


        //保存用户浏览记录
        $post_record = new PostRecords();
        $post_record->addRecord($id);

        //step3.传数据给视图渲染

        return $this->render('detail',[
            'model'=>$model,
//            'tags'=>$tags,
//            'comments'=>$recentComments,
//            'commentModel'=>$commentModel,
//            'added'=>$this->added,
            'query' => $sameQuery,
        ]);

    }

    public function actionUniversity($id)
    {
        if (($model = University::findOne($id)) == null) throw new NotFoundHttpException('The requested page does not exist.');


        //step3.传数据给视图渲染

        return $this->render('universitydetail',[
            'model'=>$model,
        ]);

    }

    /**
     * 点赞方法
     */
    public function actionLaud()
    {
        if (!Yii::$app->request->isAjax) return;
        if (Yii::$app->user->isGuest) {
            return '点赞请先登录';
        }
        $post_id = Yii::$app->request->post('id');
        $user_id = Yii::$app->user->id;
        $type = Favorite::TYPE_LAUD;
        $query = Favorite::find();
        $query->where(['user_id'=>$user_id,'post_id'=>$post_id,'type'=>$type]);
        $data = $query->asArray()->one();
        if (empty($data)) {
            $model = new Favorite();
            $model->post_id = $post_id;
            $model->user_id = $user_id;
            $model->type = $type;
            $model->save();

            $postModel = $this->findModel($post_id);
            $postModel->laud_count +=1;
            $postModel->save();

            return 1;
        }else{
            Favorite::deleteAll(['user_id'=>$user_id,'post_id'=>$post_id,'type'=>$type]);
            $postModel = $this->findModel($post_id);
            $postModel->laud_count -=1;
            $postModel->save();

            return 2;
        }


    }

    /**
     * 收藏方法
     */
    public function actionFavorite()
    {
        if (!Yii::$app->request->isAjax) return;
        if (Yii::$app->user->isGuest) {
            return '收藏请先登录';
        }
        $post_id = Yii::$app->request->post('id');
        $user_id = Yii::$app->user->id;
        $type = Favorite::TYPE_FAVORITE;
        $query = Favorite::find();
        $query->where(['user_id'=>$user_id,'post_id'=>$post_id,'type'=>$type]);
        $data = $query->asArray()->one();
        if (empty($data)) {
            $model = new Favorite();
            $model->post_id = $post_id;
            $model->user_id = $user_id;
            $model->type = $type;
            $model->save();

            $postModel = $this->findModel($post_id);
            $postModel->laud_count +=1;
            $postModel->save();

            return 1;
        }else{
            Favorite::deleteAll(['user_id'=>$user_id,'post_id'=>$post_id,'type'=>$type]);
            $postModel = $this->findModel($post_id);
            $postModel->laud_count -=1;
            $postModel->save();

            return 2;
        }

    }
}
