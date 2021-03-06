<?php
use frontend\components\HotTagsWidget;
use frontend\components\SearchHistoryWidget;
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
        <?= SearchHistoryWidget::widget(['keywords'=>$keyword]);?>
        <span>热点搜索</span>

        <p>
            <?= HotTagsWidget::widget(['tags'=>$tags]);?>
        </p>
    </div>



</div>
