<?php
use frontend\components\HotTagsWidget;
use yii\helpers\Url;
?>
<div class="header header1">
    <div class="logo">
        <a href="<?=Url::to(Yii::$app->homeUrl) ?>"></a>
    </div>
    <div class="header_find2">
        <form action="<?= Yii::$app->urlManager->createUrl(['/search/detail']);?>" method="get">
            <input type="text" id="search_input" placeholder="签证"  name="keywords" required />
            <input type="submit" value="搜 索" />
        </form>
    </div>
</div>
<div class="con">
    <div class="con_sousuo">
       <span>历史搜索</span>
        <p>
            <a href="javascript:;">面签</a>
            <a href="javascript:;">公派</a>
        </p>
        <span>热点搜索</span>

        <p>
            <?= HotTagsWidget::widget(['tags'=>$tags]);?>
        </p>
    </div>



</div>
