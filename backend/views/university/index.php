<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '大学信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增大学', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'id',
                'contentOptions'=>['width'=>'20px'],
            ],
            'name',
            'english_name',
//            'content:ntext',
            [
                'attribute'=>'content',
                'value'=>'beginning',
            ],
//            'logo',
            [
                'attribute' => 'logo',
                'label' => '照片',
                'format' => 'raw',
                'value' =>function($model){
                    return Html::a(Html::img($model->logo, ['width' => 80]),$model->logo);
                }
            ],
            // 'status',
            // 'create_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
