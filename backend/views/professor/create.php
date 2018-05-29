<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Professor */

$this->title = '新增教授';
$this->params['breadcrumbs'][] = ['label' => '教授信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
