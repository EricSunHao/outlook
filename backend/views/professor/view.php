<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Professor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '教授信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除本条信息吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'university',
            'title',
            'summary:ntext',
            'major',
            'department',
            'email:email',
            [
                'attribute' => 'photo',
                'label' => '照片',
                'format' => 'raw',
                'value' => Html::a(Html::img($model->photo, ['width' => 80]),$model->photo),
            ],
            [
                'attribute'=>'created_time',
                'value'=>date("Y-m-d H:i:s",$model->created_time),
            ],
        ],
    ]) ?>

</div>
