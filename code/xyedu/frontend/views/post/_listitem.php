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
        <a href="javascript:;" postid="<?= $model->id?>" class="right_redian_zan"><em><?= $model->laud_count;?></em>赞</a>
        <a href="javascript:;" postid="<?= $model->id?>" class="right_redian_cang"><em><?= $model->favorite_count;?></em>收藏</a>
        <a href="javascript:;" class="right_redian_xiang"></a>
        <span><?= date('Y-m-s',$model->update_time);?></span>
    </div>
</li>
