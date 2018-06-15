<?php
use kop\y2sp\ScrollPager;
use yii\widgets\ListView;
?>
<div class="con">
    <div class="con_dingdan">
        <div class="con_dingdan_title">
            我的订单
        </div>
        <div class="con_dingdan_list">
            <div class="con_dingdan_list_box">
                <a href="javascript:;">
                    <img src="/wx/img/img2.png" />
                    <p>
							  <span>
								  <i>签证指导</i>
								  <em>￥1000</em>
							  </span>
                        <i>已购</i>
                    </p>
            </div>

            <div class="con_dingdan_list_box">
                <a href="javascript:;">
                    <img src="/wx/img/img2.png" />
                    <p>
							  <span>
								  <i>签证指导</i>
								  <em>￥1000</em>
							  </span>
                        <i>已购</i>
                    </p>
            </div>

        </div>

        <div class="con_dingdan_title con_dingdan_title2">
            我的收藏
        </div>
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



</div>
