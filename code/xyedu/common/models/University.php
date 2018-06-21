<?php

namespace common\models;

use Yii;
use common\models\UploadForm;
use yii\web\UploadedFile;

/**
 * This is the model class for table "university".
 *
 * @property integer $id
 * @property string $name_cn
 * @property string $name_en
 * @property string $content
 * @property string $logo
 * @property int $ranking
 * @property integer $status
 * @property integer $create_time
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_cn', 'name_en', 'content','ranking'], 'required'],
            [['content'], 'string'],
            [['name_cn'], 'string', 'max' => 128],
            [['name_en'], 'string', 'max' => 155],
            [['ranking','status'], 'integer'],
//            [['logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_cn' => '名称',
            'name_en' => '英文名称',
            'content' => '简介',
            'logo' => 'Logo',
            'ranking' => '排名',
            'status' => '排名分类',
            'create_time' => '创建时间',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $upload = new UploadForm();

            if (Yii::$app->request->isPost) {
                $upload->file = UploadedFile::getInstance($this, 'logo');
                if ($upload->file && $upload->validate()) {
                    $upload->file->saveAs(Yii::getAlias('@backend') .'/web/Uploads/university/'. $upload->file->baseName . '.' . $upload->file->extension);
                    $this->logo = '/Uploads/university/'. $upload->file->baseName . '.' . $upload->file->extension;
                }
            }
            if($insert)
            {
                $this->create_time = time();
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getBeginning($length=30)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['post/university','id'=>$this->id]
        );
    }

    public function getStatusName()
    {
        if ($this->status == 1)
        {
            return '大学排名';
        }else{
            return '医院排名';
        }

    }
}
