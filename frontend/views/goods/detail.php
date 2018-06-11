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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>订单支付</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <meta name="wap-font-scale" content="no">
    <script src="<?= Yii::$app->request->baseUrl ?>/wx/js/jquery-2.1.4.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/wx/js/ind.js"></script>
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/wx/css/css.css">
</head>
<body>

<div class="con con_m">
    <div class="dingdan">
        <?= $model->content?>
        <!--        <div class="dingdan_top">-->
        <!--            <img src="./img/img2.png" />-->
        <!--            <p>学校清单</p>-->
        <!--        </div>-->
        <!---->
        <!--        <div class="dingdan_con">-->
        <!--            <p>-->
        <!--                在英国大学开设的众多学位中，创意设计类占有很大的比例，且该类学位的层次多样。英国留国留学文科专业可选的创意设计类有戏剧、电国留国留影、电视、数码等专业。英国留国留学文科专业可选的创意设计类有戏剧。-->
        <!--            </p>-->
        <!---->
        <!--            <img src="./img/img2.png" />-->
        <!--            <p>-->
        <!--                在英国大学开设的众多学位中，创意设计类占有很大的比例，且该类学位的层次多样。英国留国留学文科专业可选的创意设计类有戏剧、电国留国留影、电视、数码等专业。英国留国留学文科专业可选的创意设计类有戏剧。-->
        <!--            </p>-->
        <!--        </div>-->
    </div>



</div>

<div class="footer footer2">
    <p>￥<i><?= $model->price;?></i></p>
    <a href="#">去支付</a>
</div>
</body>
</html>
