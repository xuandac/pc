<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $Link
 * @property integer $ParentID
 * @property string $StructureCode
 * @property integer $Order
 * @property string $DateCreate
 * @property string $DateUpdate
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ParentID', 'Order'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Name', 'Link', 'StructureCode'], 'string', 'max' => 255],
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
            'Link' => 'Link',
            'ParentID' => 'Parent ID',
            'StructureCode' => 'Structure Code',
            'Order' => 'Order',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
        ];
    }
}
