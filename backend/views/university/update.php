<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\University */

$this->title = '更新信息: ' . $model->name_cn;
$this->params['breadcrumbs'][] = ['label' => '排名信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_cn, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="university-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
