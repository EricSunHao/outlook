<?php
use yii\helpers\Html;

?>
<li>
    <a href="<?= $model->url;?>">
        <?= $model->ranking?>.<?= $model->name_cn?>.<?= $model->name_en?>
    </a>
</li>