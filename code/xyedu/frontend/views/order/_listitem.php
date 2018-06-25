<?php
use yii\helpers\Html;
use common\models\Favorite;
?>
<li>
    <div class="right_redian_t">
        <h2><?= Html::encode($model->post->title);?></h2>
        <a href="<?= $model->post->url;?>">
            <?= $model->post->beginning;?>
        </a>
    </div>

    <?php $cang= Favorite::getFavStatus(Favorite::TYPE_FAVORITE,$model->post_id);$zan = Favorite::getFavStatus(Favorite::TYPE_LAUD,$model->post_id) ?>
    <div class="right_redian_s">
        <a href="javascript:;" postid="<?= $model->post_id?>" class=<?php if ($zan){echo 'right_redian_zan1';}else{echo 'right_redian_zan';} ?>><em><?= $model->post->laud_count;?></em>赞</a>
        <a href="javascript:;" postid="<?= $model->post_id?>" class=<?php if ($cang){echo 'right_redian_cang1';}else{echo 'right_redian_cang';} ?>><em><?= $model->post->favorite_count;?></em>收藏</a>
        <a href="javascript:;" class="right_redian_xiang"></a>
        <span><?= date('Y-m-d',$model->post->update_time);?></span>
    </div>
</li>
