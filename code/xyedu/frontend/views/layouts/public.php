<?php
use yii\helpers\Url;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>轩洋教育</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <meta name="wap-font-scale" content="no">
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/wx/css/css.css">
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b081c308763e2f27fd3aee1839d746b9";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header header1">
    <div class="logo">
        <a href="<?=Url::to(Yii::$app->homeUrl) ?>"></a>
    </div>
    <div class="header_find1">
        <a href="<?=Url::to('/search/index.html') ?>">
            <span>查找</span>
        </a>
    </div>
</div>

<?php echo $content;?>

<div class="footer footer1">
    <?php $name = Yii::$app->controller->id; ?>
    <ul>
        <li>
            <?php if ($name=='post'){?>
            <a href="<?=Url::to(Yii::$app->homeUrl) ?>" class="on">
                <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img1_2.png" />
                <span>首页</span>
            </a>
            <?php }else{ ?>
            <a href="<?=Url::to(Yii::$app->homeUrl) ?>">
                <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img1.png" />
                <span>首页</span>
            </a>
            <?php } ?>
        </li>
        <li>
            <?php if ($name=='goods'){?>
                <a href="<?=Url::to('/goods/index.html') ?>" class="on">
                    <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img2_2.png" />
                    <span>服务</span>
                </a>
            <?php }else{ ?>
                <a href="<?=Url::to('/goods/index.html') ?>">
                    <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img2.png" />
                    <span>服务</span>
                </a>
            <?php } ?>
        </li>
        <li>
            <?php if ($name=='order'){?>
                <a href="<?=Url::to('/order/index.html') ?>" class="on">
                    <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img3_2.png" />
                    <span>我</span>
                </a>
            <?php }else{ ?>
                <a href="<?=Url::to('/order/index.html') ?>">
                    <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img3.png" />
                    <span>我</span>
                </a>
            <?php } ?>
        </li>

    </ul>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script src="/wx/js/ind.js"></script>
