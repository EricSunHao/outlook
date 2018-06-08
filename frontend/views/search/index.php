<?php
use frontend\components\HotTagsWidget;
?>
<div class="con">
    <div class="con_sousuo">
			   <span>
			       历史搜索
			   </span>
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
