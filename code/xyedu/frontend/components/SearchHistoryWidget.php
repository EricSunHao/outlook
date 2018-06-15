<?php
namespace frontend\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class SearchHistoryWidget extends Widget
{
    public $keywords;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $String='<span>历史搜索</span><p>';

        foreach ($this->keywords as $keyword)
        {
            $url = Yii::$app->urlManager->createUrl(['/search/detail','keywords'=>$keyword]);
            $String.='<a href="'.$url.'">'.$keyword.'</a>';
        }
        return $String.'</p>';

    }









}