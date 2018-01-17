<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Summary
 * @property string $Slug
 * @property string $Thumb
 * @property string $Content
 * @property string $Tags
 * @property string $CategoriesID
 * @property integer $Status
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $CreateUser
 * @property integer $UpdateUser
 * @property string $SEO_Title
 * @property string $SEO_Description
 * @property string $SEO_Keywords
 * @property string $SEO_Canonical
 * @property string $SEO_301
 * @property string $DatePublic
 * @property integer $FeaturedNews
 * @property integer $Focus
 * @property integer $hot
 * @property integer $Type
 * @property integer $IsDelete
 * @property integer $Post_Type
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Thumb', 'Content'], 'string'],
            [['Status', 'CreateUser', 'UpdateUser', 'FeaturedNews', 'Focus', 'hot', 'Type', 'IsDelete','Post_Type'], 'integer'],
            [['DateCreate', 'DateUpdate', 'DatePublic'], 'safe'],
            [['Title', 'Slug', 'Tags', 'SEO_Title', 'SEO_Description', 'SEO_Keywords', 'SEO_Canonical', 'SEO_301'], 'string', 'max' => 255],
            [['Summary'], 'string', 'max' => 300],
            [['CategoriesID'], 'string', 'max' => 200],
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
            'Summary' => 'Summary',
            'Slug' => 'Slug',
            'Thumb' => 'Thumb',
            'Content' => 'Content',
            'Tags' => 'Tags',
            'CategoriesID' => 'Categories ID',
            'Status' => 'Status',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'CreateUser' => 'Create User',
            'UpdateUser' => 'Update User',
            'SEO_Title' => 'Seo  Title',
            'SEO_Description' => 'Seo  Description',
            'SEO_Keywords' => 'Seo  Keywords',
            'SEO_Canonical' => 'Seo  Canonical',
            'SEO_301' => 'Seo 301',
            'DatePublic' => 'Date Public',
            'FeaturedNews' => 'Featured News',
            'Focus' => 'Focus',
            'hot' => 'Hot',
            'Type' => 'Type',
            'IsDelete' => 'Is Delete',
        ];
    }
}
