<?php

// CLASS Tags

class Stats{
	private $user;
    private $game;


    public function __construct($game = null, $user = null){
		if(!empty($game)){
			$this->game = $game;
		}
        if(!empty($user)){
            $this->user = $user;
        }
	}
	
	public function GetAnonymous($type){
		global $db;

        switch ($type){
            case "Players":
                $select = "SAnonym_Players";
                break;
            case "Ground":
                $select = "SAnonym_Ground";
                break;
            case "Team":
                $select = "SAnonym_Team";
                break;
            case "Complete":
                $select = "SAnonym_Complete";
                break;
            case "Cheater":
                $select = "SAnonym_Cheater";
                break;
            case "Managment":
                $select = "SAnonym_Managment";
                break;
            default:
                return 0;
                break;
        }

        $params = array(array("code"=>":game","value"=>$this->game));
        $sqlSelect = $db->Query("SELECT $select FROM ".constant("db_prefix")."module_statsanonymous WHERE SAnonym_GameID = :game",$params);
		
		if($sqlSelect){
            $data = array();

            foreach ($db->QueryData as $value){
                $data[] = $value[0];
            }

            $sum = array_sum($data);
            $count = count($data);
            $average = $sum / $count;

            return round($average);
		} else {
			return false;
		}
		
	}

    public function GetStatsNanAAll($by = "game"){
        global $db;

        if($by == "game"){
            $params = array(array("code"=>":id","value"=>$this->game));
            $sqlSelect = $db->Query("SELECT Stats_Kills, Stats_Deaths FROM ".constant("db_prefix")."module_stats WHERE Stats_GameID = :id",$params);
        } else {
            $params = array(array("code"=>":id","value"=>$this->user));
            $sqlSelect = $db->Query("SELECT Stats_Kills, Stats_Deaths FROM ".constant("db_prefix")."module_stats WHERE Stats_UserID = :id",$params);
        }

        if($sqlSelect){
            $dataDeath = array();
            $dataKill = array();

            foreach ($db->QueryData as $value){
                $dataKill[] = $value["Stats_Kills"];
                $dataDeath[] = $value["Stats_Deaths"];

            }

            $sumKill = array_sum($dataKill);
            $sumDeath = array_sum($dataDeath);

            $countKill = count($dataKill);
            $countDeath = count($dataDeath);

            $averageKill = round(($sumKill / $countKill), 2);
            $averageDeath = round(($sumDeath / $countDeath), 2);

            $ret = array("k" => $averageKill, "d" => $averageDeath);

            return $ret;
        } else {
            return false;
        }
    }

    function Controll(){
        global $db;
        $params = array(array("code"=>":game","value"=>$this->game),array("code"=>":user","value"=>$this->user));

        $sqlSelect = $db->Query("SELECT Stats_GameID FROM ".constant("db_prefix")."module_stats WHERE Stats_GameID = :game AND Stats_UserID = :user LIMIT 1",$params);

        if($sqlSelect){
            $data = $db->QueryData[0];
            if(empty($data[0])){
                return true;
            }else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function CreateAnonymous($p = "",$g = "", $t = "", $c = "", $ch = "", $m = ""){
        global $db;

        $params = array(
            array("code"=>":game","value"=>$this->game),
            array("code"=>":p","value"=>$p),
            array("code"=>":g","value"=>$g),
            array("code"=>":t","value"=>$t),
            array("code"=>":c","value"=>$c),
            array("code"=>":ch","value"=>$ch),
            array("code"=>":m","value"=>$m)

        );
        $sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."module_statsanonymous 
        (SAnonym_GameID, SAnonym_Players, SAnonym_Ground, SAnonym_Team, SAnonym_Complete, SAnonym_Cheater, SAnonym_Managment) VALUES
        (:game, :p, :g, :t, :c, :ch, :m);",$params);

        if($sqlSelect){
            return true;
        } else {
            return false;
        }
    }

    public function CreateStats($k = "",$d = ""){
        global $db;

        $params = array(
            array("code"=>":game","value"=>$this->game),
            array("code"=>":user","value"=>$this->user),
            array("code"=>":k","value"=>$k),
            array("code"=>":d","value"=>$d)
        );
        $sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."module_stats 
        (Stats_UserID, Stats_GameID, Stats_Kills, Stats_Deaths) VALUES
        (:user, :game, :k, :d);",$params);

        if($sqlSelect){
            return true;
        } else {
            return false;
        }
    }
	
}


?>