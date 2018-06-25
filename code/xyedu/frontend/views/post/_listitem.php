<?php
use yii\helpers\Html;
use common\models\Favorite;

?>
<li class="item_post">
    <div class="right_redian_t">
        <h2><?= Html::encode($model->title);?></h2>
        <a href="<?= $model->url;?>">
            <?= $model->beginning;?>
        </a>
    </div>

    <?php $cang= Favorite::getFavStatus(Favorite::TYPE_FAVORITE,$model->id);$zan = Favorite::getFavStatus(Favorite::TYPE_LAUD,$model->id) ?>
    <div class="right_redian_s">
        <a href="javascript:;" postid="<?= $model->id?>" class=<?php if ($zan){echo 'right_redian_zan1';}else{echo 'right_redian_zan';} ?>><em><?= $model->laud_count;?></em>赞</a>
        <a href="javascript:;" postid="<?= $model->id?>" class=<?php if ($cang){echo 'right_redian_cang1';}else{echo 'right_redian_cang';} ?>><em><?= $model->favorite_count;?></em>收藏</a>
        <a href="javascript:;" class="right_redian_xiang"></a>
        <span><?= date('Y-m-d',$model->update_time);?></span>
    </div>
</li>
