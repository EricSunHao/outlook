<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<!--    --><?//= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model,'type')
        ->dropDownList(\common\models\Category::getAllType(),['prompt'=>'请选择状态']) ?>
    <?= $form->field($model, 'hot')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
