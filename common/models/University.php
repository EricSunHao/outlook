<?php

namespace common\models;

use Yii;
use common\models\UploadForm;
use yii\web\UploadedFile;

/**
 * This is the model class for table "university".
 *
 * @property integer $id
 * @property string $name
 * @property string $english_name
 * @property string $content
 * @property string $logo
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
            [['name', 'english_name', 'content'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['english_name'], 'string', 'max' => 155],
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
            'name' => '学校名称',
            'english_name' => '学校英文名称',
            'content' => '学校简介',
            'logo' => 'Logo',
            'status' => '展示状态',
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
                $this->status = 1;
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
}
