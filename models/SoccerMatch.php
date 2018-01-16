<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soccer_match".
 *
 * @property integer $ID
 * @property integer $MatchId
 * @property integer $HomeId
 * @property integer $AWayId
 * @property string $Score
 * @property string $StartTime
 * @property integer $Status
 * @property integer $LeagueId
 * @property integer $SeasonId
 * @property integer $AutoRun
 * @property string $DateCreate
 * @property string $DateUpdate
 */
class SoccerMatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soccer_match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MatchId', 'HomeId', 'AWayId', 'Status', 'LeagueId', 'SeasonId', 'AutoRun'], 'integer'],
            [['StartTime', 'DateCreate', 'DateUpdate'], 'safe'],
            [['Score'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MatchId' => 'Match ID',
            'HomeId' => 'Home ID',
            'AWayId' => 'Away ID',
            'Score' => 'Score',
            'StartTime' => 'Start Time',
            'Status' => 'Status',
            'LeagueId' => 'League ID',
            'SeasonId' => 'Season ID',
            'AutoRun' => 'Auto Run',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
        ];
    }
}
