<?php

use yii\widgets\ListView;
use kop\y2sp\ScrollPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="header header1">
    <div class="logo">
        <a href="<?=Url::to(Yii::$app->homeUrl) ?>"></a>
    </div>
    <div class="header_find2">
        <form action="<?= Yii::$app->urlManager->createUrl(['/search/detail']);?>" method="get">
            <input type="text" id="search_input" value="<?=$searchInput?>"  name="keywords" required />
            <input type="submit" value="搜 索" />
        </form>
    </div>
</div>
<div class="con">
    <div class="con_sousuo_list">
        <div class="sousuo_list_title">
            轩洋教育为您找到“<em style="color: red"><?=$searchInput?></em>”相关结果<i><?=$searchCount?></i>条：
        </div>

        <div class="right_redian">
            <ul>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,//Yii2数据提供器
                    'itemOptions'   => ['class' => 'item'],
                    'itemView'      => '_listitem',
                    'layout' => '{items}{pager}',
                    'viewParams' => [
                        'key' => $searchInput,
                    ],
                    'pager'         => [
                        'class' => ScrollPager::className(),
                        'triggerOffset' => 99,
                        'triggerText'=>'点击加载更多',
                        'noneLeftText' => '没有更多了~',
                    ]
                ]);
                ?>

            </ul>
        </div>
        <div class="con_sousuo_list_b">
            <p>
                搜索过“访问学者”的用户，还搜索“<span>面签</span>”、“<span>签证指导</span>”
            </p>
        </div>

    </div>



</div>