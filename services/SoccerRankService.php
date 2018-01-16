<?php

/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 22, 2017, 9:16:41 AM. 
 * *********************************************
 */

namespace app\services;

use app\models\SoccerRank;
use yii\db\Expression;
use yii\db\Query;
use yii\data\Pagination;

class SoccerRankService {

    public function get_rank($limit=null,$where=array(), $where_1 = null, $where_2 = null) {
        $query = new Query();
        $Data_Match = $query->select([
                    'a.ID', 'a.LeagueID', 'a.SeasonID', 'a.ST', 'a.Home_T', 'a.Home_H', 'a.Home_B', 'a.Home_TG','a.Home_TH',
                    'a.Away_T','a.Away_H','a.Away_B','a.Away_TG','a.Away_TH','a.HS','a.Point','a.Position',
                    'b.Name as NameLeague',
                    'c.Name as NameTeam','c.Logo',                  
                    'd.StartTime as Season_StartTime', 'd.EndTime as Season_EndTime'
                ])->from('soccer_rank as a')
                ->innerJoin('soccer_league as b', 'a.LeagueID = b.LeagueId')               
                ->innerJoin('team as c', 'a.Team_ID = c.AutoId')                 
                ->innerJoin('soccer_season as d', 'a.SeasonID = d.ID')
                ->limit($limit)
                //->groupBy('a.ID')
                ->orderBy('a.Position ASC')
                ->where($where)
                //->andWhere(['<=', 'd.StartTime',$where_1])
                //->andWhere(['=>', 'd.StartTime',$where_2])
                // ->asArray()            
                ->all();

        return array('data' => $Data_Match);
    }

  
  
}
