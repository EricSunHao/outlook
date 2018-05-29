<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
Use common\models\Poststatus;
use yii\helpers\ArrayHelper;
use common\models\Adminuser;
use backend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,"/css/umeditor/themes/default/css/umeditor.css");
AppAsset::addScript($this,"/css/umeditor/third-party/template.min.js");
AppAsset::addScript($this,"/css/umeditor/umeditor.config.js");
AppAsset::addScript($this,"/css/umeditor/umeditor.min.js");
AppAsset::addScript($this,"/css/umeditor/lang/zh-cn/zh-cn.js");

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'category_id')
        ->dropDownList(\common\models\Category::find()
            ->select(['name','id'])
            ->indexBy('id')
            ->column(),['prompt'=>'请选择分类']
        )

    ?>

    <?= $form->field($model,'content')->textarea(["style" => "width:100%;height:500px;",'id'=>'content'])?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
<?
//方法一
//    $psObj = Poststatus::find()->all();
//    $allStatus = \yii\helpers\ArrayHelper::map($psObj,'id','name');
//方法二
    $allStatus =(new \yii\db\Query())
        ->select(['name','id'])
        ->from('poststatus')
        ->orderBy('position')
        ->indexBy('id')
        ->column();
    ?>
    <?= $form->field($model,'status')
        ->dropDownList($allStatus,['prompt'=>'请选择状态']) ?>

     <?= $form->field($model,'author_id')
        ->dropDownList(\common\models\Adminuser::find()
        ->select(['nickname','id'])
        ->indexBy('id')
        ->column(),['prompt'=>'请选择作者']
        )

     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增':'修改', ['class' => 'btn btn-success']) ?>
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
