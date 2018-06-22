<?php

use common\models\Category;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;
use kop\y2sp\ScrollPager;
use yii\widgets\Pjax;
?>

<div class="con">
    <div class="left">
        <ul>
            <?php foreach($category as $cg): ?>

                <li <? if ($cg->id==$category_id) echo "class='on'";?>>
                    <?= Html::a($cg->name, '/post/index.html', [
                        'data' => [
                            'method' => 'post',
                            'params' => [
                                'PostSearch[category_id]'=>$cg->id
                            ]
                        ]
                    ])?>
                </li>

            <?php endforeach;?>
        </ul>
    </div>

    <?php if ($category_type == Category::TYPE_SCHOOL){ ?>
    <div class="right">
        <div class="right_daxue">
            <ul>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,//Yii2数据提供器
                    'itemOptions'   => ['class' => 'item'],
                    'itemView'      => '_schoolitem',
                    'layout' => '{items}{pager}',
                    'pager'         => [
                        'class' => ScrollPager::className(),
                        'triggerOffset' => 99,
                        'triggerText'=>'点击加载更多',
                        'noneLeftText' => '',
                    ]
                ]);
                ?>
            </ul>
        </div>
    </div>
    <?php }?>

    <?php if ($category_type == Category::TYPE_HOSPITAL){ ?>
        <div class="right">
            <div class="right_daxue">
                <ul>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,//Yii2数据提供器
                        'itemOptions'   => ['class' => 'item'],
                        'itemView'      => '_schoolitem',
                        'layout' => '{items}{pager}',
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
        </div>
    <?php }?>

    <?php if ($category_type == Category::TYPE_POST){ ?>
    <div class="right">
        <div class="right_redian">
            <ul>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,//Yii2数据提供器
                    'itemOptions'   => ['class' => 'item'],
                    'itemView'      => '_listitem',
                    'layout' => '{items}{pager}',
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
    </div>
    <?php }?>
</div>
