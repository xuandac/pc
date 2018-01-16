<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $ID
 * @property string $Iframe
 * @property string $Video_File
 * @property integer $Post_Id
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Iframe'], 'string'],
            [['Post_Id'], 'integer'],
            [['Video_File'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Iframe' => 'Iframe',
            'Video_File' => 'Video  File',
            'Post_Id' => 'Post  ID',
        ];
    }
}
