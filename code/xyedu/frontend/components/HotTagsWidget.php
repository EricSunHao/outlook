<?php
namespace frontend\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class HotTagsWidget extends Widget
{
    public $tags;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $tagString='';

        foreach ($this->tags as $tag)
        {
            $url = Yii::$app->urlManager->createUrl(['/search/detail','keywords'=>$tag]);
            $tagString.='<a href="'.$url.'">'.$tag.'</a>';
        }
//        sleep(3);
        return $tagString;

    }









}