<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\University */

$this->title = '新增排名';
$this->params['breadcrumbs'][] = ['label' => '排名信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
