<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\Favorite;
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
//        $tags = Tag::findTagWeights();
//        $comments = Comment::findRecentComments();
        $getParams = Yii::$app->request->get();
//        var_dump($getParams);
        if (empty($getParams) || empty($getParams['PostSearch']))
        {$category_id=1;}else{
            $category_id = $getParams['PostSearch']['category_id'];
        };

        $category_type = Category::findOne($category_id)->type;
        $category = Category::findHotCategory(5);
        if ($category_type == Category::TYPE_POST){
            $searchModel = new PostSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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
        }


        return $this->render('index', [
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'category_id' => $category_id,
            'category_type' => $category_type,
//            'comments' => $comments,
//            'tags' => $tags,
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
        $tags=Tag::findTagWeights();
        $recentComments=Comment::findRecentComments();

        if (isset(Yii::$app->user->id)){
            $userMe = User::findOne(Yii::$app->user->id);
            $commentModel = new Comment();
            $commentModel->email = $userMe->email;
            $commentModel->userid = $userMe->id;

            //step2. 当评论提交时，处理评论
            if($commentModel->load(Yii::$app->request->post()))
            {
                $commentModel->status = 1; //新评论默认状态为 pending
                $commentModel->post_id = $id;
                if($commentModel->save())
                {
                    $this->added=1;
                }
            }
        }else{
            $commentModel = '';
        }


        //step3.传数据给视图渲染

        return $this->render('detail',[
            'model'=>$model,
            'tags'=>$tags,
            'comments'=>$recentComments,
            'commentModel'=>$commentModel,
            'added'=>$this->added,
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

    public function actionTest()
    {
        echo __METHOD__;die;
        $info = $this->getPhoneType();
        $data = $info.uniqid();
//        $data['code'] = md5($data['uncode']);
        var_dump($data);die;
    }
    /**
     * 函数名称: getUA
     * 函数功能: 取UA
     * 输入参数: none
     * 函数返回值: 成功返回号码，失败返回false
     * 其它说明: 说明
     */
    function getUA(){
        if (isset($_SERVER['HTTP_USER_AGENT'])){
            Return $_SERVER['HTTP_USER_AGENT'];
        }else{
            Return false;
        }
    }
    /**
     * 函数名称: getPhoneType
     * 函数功能: 取得手机类型
     * 输入参数: none
     * 函数返回值: 成功返回string，失败返回false
     * 其它说明: 说明
     */
    function getPhoneType(){
        $ua = $this->getUA();
        if($ua!=false){
            preg_match("/(?:\()(.*?)(?:\))/i",$ua,$str1);
            Return $str1[1];
        }else{
            Return false;
        }
    }
}
