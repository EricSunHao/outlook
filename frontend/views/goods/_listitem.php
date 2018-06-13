<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<li>
    <a href="<?= $model->url;?>">
        <p>
            <img src="<?= $model->photoUrl;?>" alt="">
        </p>
        <p>
            <span><?= Html::encode($model->name);?></span>
            <i>￥<?= $model->price;?></i>
        </p>
    </a>
</li>
