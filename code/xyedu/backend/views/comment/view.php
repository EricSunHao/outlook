<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '评论', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除本条评论?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
//            'status',
            [
                 'attribute'=>'status',
                'value'=>$model->status0->name,
            ],
            'create_time:datetime',
//            'userid',
            [
                    'attribute'=>'userid',
                'value'=>$model->user->username,
            ],
            'email:email',
            'url:url',
//            'post_id',
            [
                    'attribute'=>'post_id',
                'label'=> '文章标题',
                'value'=>$model->post->title,
            ],
            'remind',
        ],
    ]) ?>

</div>
