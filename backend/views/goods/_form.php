<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,"/css/umeditor/themes/default/css/umeditor.css");
AppAsset::addScript($this,"/css/umeditor/third-party/template.min.js");
AppAsset::addScript($this,"/css/umeditor/umeditor.config.js");
AppAsset::addScript($this,"/css/umeditor/umeditor.min.js");
AppAsset::addScript($this,"/css/umeditor/lang/zh-cn/zh-cn.js");

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model,'photo')->fileInput()?>

    <?= $form->field($model,'content')->textarea(["style" => "width:100%;height:500px;",'id'=>'content'])?>

    <?= $form->field($model,'status')
        ->dropDownList([1=>'上架',
            0=>'待上架']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock("js-block") ?>
    $(function () {
    var um = UM.getEditor("content", {
    });
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["js-block"], \yii\web\View::POS_END); ?>