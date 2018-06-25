<?php

use common\models\Favorite;
use yii\helpers\Html;
use yii\widgets\ListView;
use common\models\Post;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use common\models\Comment;


/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="con">
    <div class="con_1">
        <div class="con_1_n">
            <h2>
                <?= Html::encode($model->title);?>
            </h2>

<!--            <p>-->
                <?= HTMLPurifier::process($model->content)?>
<!--            </p>-->
        </div>

<?php $cang= Favorite::getFavStatus(Favorite::TYPE_FAVORITE,$model->id);$zan = Favorite::getFavStatus(Favorite::TYPE_LAUD,$model->id) ?>
        <div class="right_redian_s">
            <a href="javascript:;" postid="<?= $model->id?>" class=<?php if ($zan){echo 'right_redian_zan1';}else{echo 'right_redian_zan';} ?>><em><?= $model->laud_count;?></em>赞</a>
            <a href="javascript:;" postid="<?= $model->id?>" class=<?php if ($cang){echo 'right_redian_cang1';}else{echo 'right_redian_cang';} ?>><em><?= $model->favorite_count;?></em>收藏</a>
            <a href="javascript:;" class="right_redian_xiang"></a>
            <span><?= date('Y-m-d',$model->update_time);?></span>
        </div>


        <div class="con_1_b">
            <p>
                阅读过本文的用户，还阅读过：
            </p>
<!--            <a href="#">1.访问学者语言如何通过考试？（82%用户）</a>-->
<!--            <a href="#">2.访问学者面试应该如何准备？（69%用户）</a>-->
            <?php
            if (!empty($query)){
                foreach ($query as $k=>$v){
                    $num = (int)$k+1;
                    if ($v->id != $model->id){
                        echo "<a href='{$v->url}'>$num.$v->title （$v->per%用户）</a>";
                    }
                }
            }

            ?>

        </div>
    </div>
</div>
