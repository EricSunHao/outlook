<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\data\ActiveDataProvider;
use common\models\Goods;

/**
 * PostController implements the CRUD actions for Post model.
 */
class GoodsController extends Controller
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
        $dataProvider = new ActiveDataProvider([
           'query' => Goods::find()->where("status =1"),
            'pagination'=>['pageSize'=>5],
            'sort'=>[
                'defaultOrder'=>[
                    'update_time' => SORT_DESC,
                    'id'=>SORT_DESC,
                ],
            ]

        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetail($id)
    {
        $model = $this->findModel($id);
        return $this->renderPartial('detail',['model'=>$model]);
    }
}
