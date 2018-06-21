<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '排名信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增排名', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            ['attribute'=>'id',
//                'contentOptions'=>['width'=>'20px'],
//            ],
            'name_cn',
            'name_en',
//            'content:ntext',
//            [
//                'attribute'=>'content',
//                'value'=>'beginning',
//                'contentOptions'=>['width'=>'100px'],
//            ],
//            'logo',
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' =>function($model){
                    return Html::a(Html::img($model->logo, ['width' => 80]),$model->logo);
                }
            ],
            'ranking',
            // 'status',
            [
                'attribute'=>'status',
                'value'=>'statusName',
                'filter'=>[1=>'大学排名',
                    2=>'医院排名']
            ],
            // 'create_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
