<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ic_seo".
 *
 * @property integer $ID
 * @property string $SEO_Key
 * @property string $SEO_Value
 * @property string $DateCreate
 * @property string $DateUpdate
 */
class IcSeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ic_seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SEO_Value'], 'string'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['SEO_Key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SEO_Key' => 'Seo  Key',
            'SEO_Value' => 'Seo  Value',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
        ];
    }
}
