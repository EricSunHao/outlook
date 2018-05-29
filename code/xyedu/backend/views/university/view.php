<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\University */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '大学信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除本条信息？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'english_name',
            'content:ntext',
//            'logo',
        [
            'attribute' => 'logo',
            'label' => '照片',
            'format' => 'raw',
            'value' => Html::a(Html::img($model->logo, ['width' => 80]),$model->logo),
        ],
//            'status',
            [
                'attribute'=>'create_time',
                'value'=>date("Y-m-d H:i:s",$model->create_time),
            ],
        ],
    ]) ?>

</div>