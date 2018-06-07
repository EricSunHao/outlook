<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = '新增商品服务';
$this->params['breadcrumbs'][] = ['label' => '服务信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
