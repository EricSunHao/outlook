<?php

use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

?>
<div class="con con_m">
    <div class="con_fuwu">
        <div class="con_fuwu_gg">
            <em>公告</em>
            <p>
                因以下服务均为咨询类服务，一经缴费，概不退费！
            </p>
        </div>

        <div class="con_fuwu_list">
            <ul>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => '_listitem',
                    'layout' => '{items}{pager}',
                    'pager' => ['class' => ScrollPager::className(),
                        'noneLeftText' => '没有更多了~',
                        ]
                ]);
                ?>

            </ul>
        </div>
    </div>
</div>

