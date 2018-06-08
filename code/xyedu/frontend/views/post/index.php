<?php

use yii\helpers\Url;
use yii\widgets\ListView;
?>

<div class="con">
    <div class="left">
        <ul>
            <?php foreach($category as $cg): ?>

                <li <? if ($cg->id==$category_id) echo "class='on'";?>>
                    <?= \yii\helpers\Html::a($cg->name,['post/index','PostSearch[category_id]'=>$cg->id]) ?>
                </li>

            <?php endforeach;?>
        </ul>
    </div>

    <?php if ($category_type == 2){ ?>
    <div class="right">
        <div class="right_daxue">
            <ul>
                <li>
                    <a href="#">
                        1.普林斯顿大学.Princeton,NJ
                    </a>
                </li>
                <li>
                    <a href="#">
                        1.普林斯顿大学.Princeton,NJ
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php }?>

    <?php if ($category_type == 1){ ?>
    <div class="right">
        <div class="right_redian">
            <ul class="collect_post_list">

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
    </div>
    <?php }?>
</div>