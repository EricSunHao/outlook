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
    <div class="con_sousuo_list">
        <div class="sousuo_list_title">
            轩洋教育为您找到“<em><?=$searchInput?></em>”相关结果<i><?=$searchCount?></i>条：
        </div>
        <div class="right_redian">
            <ul>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,//Yii2数据提供器
                    'layout' => '{items}{pager}',
                    'itemView' => '_listitem',//单个项目视图文件名称（即被循环输出的内容)
                    'pager' => ['class' => \kop\y2sp\ScrollPager::className(),
                        'noneLeftText'=>'已经没有更多内容了',
                        'triggerOffset'=>99,
                        'container'=>'.collect_post_list',
                        'item'=>'.item_post',
                        'eventOnReady' => 'function(){lazyload_init();}',//事件，在从服务器加载新页面后触发js函数。
                        'eventOnRendered' => 'function(){lazyload_init();}',//事件，新项目渲染后触发js函数。

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