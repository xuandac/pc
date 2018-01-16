<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Slug
 * @property string $Description
 * @property integer $ParentID
 * @property integer $Status
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $CreateUser
 * @property integer $UpdateUser
 * @property integer $ShowHomeSM
 * @property integer $ShowHomeBig
 * @property integer $ShowHomeRank
 * @property integer $ShowHomeOrderSM
 * @property integer $ShowHomeOrderBig
 * @property integer $ShowHomeOrderRank
 * @property integer $OrderMobile
 * @property string $Icon
 * @property integer $LangueID
 * @property integer $CatHot
 * @property integer $OrderCatHot
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ParentID', 'Status', 'CreateUser', 'UpdateUser', 'ShowHomeSM', 'ShowHomeBig', 'ShowHomeRank', 'ShowHomeOrderSM', 'ShowHomeOrderBig', 'ShowHomeOrderRank', 'OrderMobile', 'LangueID', 'CatHot', 'OrderCatHot'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Title', 'Slug', 'Description', 'Icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Title' => 'Title',
            'Slug' => 'Slug',
            'Description' => 'Description',
            'ParentID' => 'Parent ID',
            'Status' => 'Status',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'CreateUser' => 'Create User',
            'UpdateUser' => 'Update User',
            'ShowHomeSM' => 'Show Home Sm',
            'ShowHomeBig' => 'Show Home Big',
            'ShowHomeRank' => 'Show Home Rank',
            'ShowHomeOrderSM' => 'Show Home Order Sm',
            'ShowHomeOrderBig' => 'Show Home Order Big',
            'ShowHomeOrderRank' => 'Show Home Order Rank',
            'OrderMobile' => 'Order Mobile',
            'Icon' => 'Icon',
            'LangueID' => 'Langue ID',
        ];
    }
}
