<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>轩洋教育</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <meta name="wap-font-scale" content="no">
    <script src="<?= Yii::$app->request->baseUrl ?>/wx/js/jquery-2.1.4.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/wx/js/ind.js"></script>
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/wx/css/css.css">
</head>
<body>
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
    <ul>
        <li>
            <a href="<?=Url::to(Yii::$app->homeUrl) ?>" class="on">
                <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img1_2.png" />
                <span>首页</span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img2.png" />
                <span>服务</span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="<?= Yii::$app->request->baseUrl ?>/wx/img/footer_img3.png" />
                <span>我</span>
            </a>
        </li>

    </ul>
</div>
</body>
</html>