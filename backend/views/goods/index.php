<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '服务信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'id',
                'contentOptions'=>['width'=>'30px']],
            'name',
            [
                'attribute' => 'photo',
                'label' => '照片',
                'format' => 'raw',
                'value' =>function($model){
                    return Html::a(Html::img($model->photo, ['width' => 80]),$model->photo);
                }
            ],
//            'content:ntext',
            [
                'attribute'=>'status',
                'value'=>'statusName',
                'filter'=>[1=>'已上架',
                    2=>'待上架']
            ],
            'price',
            //'create_time:datetime',
            //'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
