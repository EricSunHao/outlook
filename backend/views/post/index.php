<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
        ['attribute'=>'id',
            'contentOptions'=>['width'=>'30px']],
            'title',
//            'author_id',
        ['attribute'=>'authorName',
        'label'=>'作者',
        'value'=>'author.nickname'],
            ['attribute'=>'category_id',
                'value'=>'category.name',
                'filter'=>\common\models\Category::find()
                    ->select(['name','id'])
                    ->where('type = 1')
                    ->indexby('id')
                    ->column(),
                ],
//            'content:ntext',
            'tags:ntext',
//            'status',
        ['attribute'=>'status',
        'value'=>'status0.name',
            'filter'=>Poststatus::find()
                    ->select(['name','id'])
                    ->orderby('position')
                    ->indexby('id')
                    ->column(),
            ],
            //'create_time:datetime',
//            'update_time:datetime',
        ['attribute'=>'update_time',
            'format'=>['date','php:Y-m-d H:i:s']],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
