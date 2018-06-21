<?php
use yii\helpers\Html;

?>
<li>
    <div class="right_redian_t">
        <h2><?= Html::encode($model->post->title);?></h2>
        <a href="<?= $model->post->url;?>">
            <?= $model->post->beginning;?>
        </a>
    </div>
    <div class="right_redian_s">
        <a href="javascript:;" postid="<?= $model->post_id?>" class="right_redian_zan"><em><?= $model->post->laud_count;?></em>赞</a>
        <a href="javascript:;" postid="<?= $model->post_id?>" class="right_redian_cang"><em><?= $model->post->favorite_count;?></em>收藏</a>
        <a href="javascript:;" class="right_redian_xiang"></a>
        <span><?= date('Y-m-s',$model->post->update_time);?></span>
    </div>
</li>
