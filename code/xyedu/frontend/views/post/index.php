<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;
use kop\y2sp\ScrollPager;

?>

<div class="con">

    <div class="left">
        <ul>
            <?php foreach($category as $cg): ?>

                <li <? if ($cg->id==$category_id) echo "class='on'";?>>
                    <?= Html::a($cg->name,['/post/index','PostSearch[category_id]'=>$cg->id]) ?>
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
                    'itemOptions'   => ['class' => 'item'],
                    'itemView'      => '_listitem',
                    'layout' => '{items}{pager}',
                    'pager'         => [
                            'class' => ScrollPager::className(),
                            'container' => '.right_redian',
                            'triggerText'=>'点击加载更多',
                            'noneLeftText' => '没有更多了~',
                    ]
                ]);
                ?>
            </ul>
        </div>
    </div>
    <?php }?>

</div>
