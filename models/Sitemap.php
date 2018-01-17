<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sitemap".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $Key
 * @property string $Value
 */
class Sitemap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sitemap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Value'], 'string'],
            [['Name', 'Key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'Key' => 'Key',
            'Value' => 'Value',
        ];
    }
}
