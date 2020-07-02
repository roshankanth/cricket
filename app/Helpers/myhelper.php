<?php

  function getmatchStatusByID($mid)
    {
        $result = \App\Point::select('team_id','score')->where('match_id', '=', $mid)->orderBy('score', 'desc')->get();
        if($result && $result[0]->score==$result[1]->score) 
        {
        	 return 'Draw';
           
        }
        elseif($result)
        {
            
             return getTeamDetailsById($result[0]->team_id,'name');
        }
        else
        {
        	return false;
        }
    }


    function getTeamDetailsById($pid,$column)
{
    $result = \App\Team::select($column)->where('id', '=', $pid)->first();
    if ($result) {
        return $result->$column;
    } else {
        return false;
    }
}


?>