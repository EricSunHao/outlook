<?php

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
                <?= Html::encode($model->name_cn);?>
            </h2>

<!--            <p>-->
                <?= HTMLPurifier::process($model->content)?>
<!--            </p>-->
        </div>

    </div>
</div>
