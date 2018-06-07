<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goods_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_time')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
