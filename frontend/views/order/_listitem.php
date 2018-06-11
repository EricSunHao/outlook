<?php
use yii\helpers\Html;

?>
<li class="item_post">
    <div class="right_redian_t">
        <h2><?= Html::encode($model->title);?></h2>
        <a href="<?= $model->url;?>">
            <?= $model->beginning;?>
        </a>
    </div>
    <div class="right_redian_s">
        <a href="javascript:;" class="right_redian_zan"><em>16</em>赞</a>
        <a href="javascript:;" class="right_redian_cang"><em>12</em>收藏</a>
        <a href="javascript:;" class="right_redian_xiang"></a>
        <span><?= date('Y-m-s H:i:s',$model->update_time);?></span>
    </div>
</li>
