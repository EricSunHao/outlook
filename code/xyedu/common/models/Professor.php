<?php

namespace common\models;

use Yii;
use common\models\UploadForm;
use yii\web\UploadedFile;
/**
 * This is the model class for table "professor".
 *
 * @property integer $id
 * @property string $name
 * @property string $university
 * @property string $title
 * @property string $summary
 * @property string $major
 * @property string $department
 * @property string $email
 * @property string $photo
 * @property integer $created_time
 */
class Professor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'professor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'university', 'summary', 'major', 'email'], 'required'],
            [['summary'], 'string'],
            [['name', 'university', 'title', 'major', 'department'], 'string', 'max' => 256],
            [['email'], 'string', 'max' => 155],
            [['email'], 'email', ],
//            [['photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'university' => '院校',
            'title' => '职称',
            'summary' => '简介',
            'major' => '主修方向',
            'department' => '院系',
            'email' => 'Email',
            'photo' => '照片',
            'created_time' => '创建时间',
        ];
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $upload = new UploadForm();

            if (Yii::$app->request->isPost) {
                $upload->file = UploadedFile::getInstance($this, 'photo');
                if ($upload->file && $upload->validate()) {
                    $upload->file->saveAs(Yii::getAlias('@backend') .'/web/Uploads/professor/'. $upload->file->baseName . '.' . $upload->file->extension);
                    $this->photo = '/Uploads/professor/'. $upload->file->baseName . '.' . $upload->file->extension;
                }
            }
            if($insert)
            {
                $this->created_time = time();
            }

            return true;

        }
        else
        {
            return false;
        }
    }
}
