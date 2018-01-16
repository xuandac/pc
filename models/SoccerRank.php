<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soccer_rank".
 *
 * @property integer $ID
 * @property integer $LeagueID
 * @property integer $SeasonID
 * @property integer $ST
 * @property integer $Home_T
 * @property integer $Home_H
 * @property integer $Home_B
 * @property integer $Home_TG
 * @property integer $Home_TH
 * @property integer $Away_T
 * @property integer $Away_H
 * @property integer $Away_B
 * @property integer $Away_TG
 * @property integer $Away_TH
 * @property string $HS
 * @property integer $Point
 * @property string $Group
 * @property integer $Team_ID
 * @property integer $Position
 * @property string $DateUpdate
 * @property string $DateCreate
 */
class SoccerRank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soccer_rank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LeagueID', 'SeasonID', 'ST', 'Home_T', 'Home_H', 'Home_B', 'Home_TG', 'Home_TH', 'Away_T', 'Away_H', 'Away_B', 'Away_TG', 'Away_TH', 'Point', 'Team_ID', 'Position'], 'integer'],
            [['DateUpdate', 'DateCreate'], 'safe'],
            [['HS'], 'string', 'max' => 100],
            [['Group'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'LeagueID' => 'League ID',
            'SeasonID' => 'Season ID',
            'ST' => 'St',
            'Home_T' => 'Home  T',
            'Home_H' => 'Home  H',
            'Home_B' => 'Home  B',
            'Home_TG' => 'Home  Tg',
            'Home_TH' => 'Home  Th',
            'Away_T' => 'Away  T',
            'Away_H' => 'Away  H',
            'Away_B' => 'Away  B',
            'Away_TG' => 'Away  Tg',
            'Away_TH' => 'Away  Th',
            'HS' => 'Hs',
            'Point' => 'Point',
            'Group' => 'Group',
            'Team_ID' => 'Team  ID',
            'Position' => 'Position',
            'DateUpdate' => 'Date Update',
            'DateCreate' => 'Date Create',
        ];
    }
}
