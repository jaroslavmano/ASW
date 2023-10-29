<?php

class Games
{
    private $id;

    public function __construct($id = null)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
    }

    public function GetGames()
    {
        global $db;

        $sqlSelect = $db->Query("SELECT * FROM " . constant("db_prefix") . "module_games");

        if ($sqlSelect) {
            return $db->QueryData;
        } else {
            return false;
        }
    }

    public function GetHistoryGames()
    {
        global $db;

        $params = array(array("code" => ":now", "value" => strtotime("now")));
        $sqlSelect = $db->Query("SELECT * FROM " . constant("db_prefix") . "module_games WHERE Game_Date <= :now ORDER BY Game_Date",$params);

        if ($sqlSelect) {
            return $db->QueryData;
        } else {
            return false;
        }
    }

    public function GetGamesBasicInfo()
    {
        global $db;

        $sqlSelect = $db->Query("SELECT * FROM " . constant("db_prefix") . "module_games");

        if ($sqlSelect) {
            $array = array();
            $sqlNames = $db->QueryData;
            foreach ($sqlNames as $name) {
                $array[$name["Game_Name"]] = array($name["Game_Name"], $name["Game_Limits"], $name["Game_Location"], $name["Game_Tickets"], $name["Game_Web"],$name["Game_Descript"] );
            }
            return json_encode(array_values($array), true);
        } else {
            return array();
        }

    }

    public function Info()
    {
        global $db;

        $params = array(array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("SELECT * FROM " . constant("db_prefix") . "module_games WHERE Game_ID = :id LIMIT 1", $params);

        if ($sqlSelect) {
            return $db->QueryData[0];
        } else {
            return false;
        }
    }

    public function Create($game, $date, $limi, $location, $tickets,$web, $descript)
    {
        global $db;

        $params = array(
            array("code" => ":game", "value" => $game),
            array("code" => ":date", "value" => $date),
            array("code" => ":limit", "value" => $limi),
            array("code" => ":loc", "value" => $location),
            array("code" => ":tick", "value" => $tickets),
            array("code" => ":web", "value" => $web),
            array("code" => ":descript", "value" => $descript),
        );
        $sqlSelect = $db->Query("INSERT INTO " . constant("db_prefix") . "module_games 
        (Game_Name, Game_Date,Game_Limits,Game_Location,Game_Tickets, Game_Web,Game_Descript) 
        VALUES
        (:game, :date,:limit,:loc,:tick, :web,:descript);", $params);

        if ($sqlSelect) {
            return $db->LastID;
        } else {
            return false;
        }
    }

    public function Update($game, $date, $limi, $location, $tickets, $web, $descript)
    {
        global $db;

        $params = array(
            array("code" => ":game", "value" => $game),
            array("code" => ":date", "value" => $date),
            array("code" => ":limit", "value" => $limi),
            array("code" => ":loc", "value" => $location),
            array("code" => ":tick", "value" => $tickets),
            array("code" => ":web", "value" => $web),
            array("code" => ":descript", "value" => $descript),
            array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("UPDATE " . constant("db_prefix") . "module_games SET 
        Game_Name=:game,
        Game_Date=:date,
        Game_Limits=:limit,
        Game_Location=:loc,
        Game_Tickets=:tick,
        Game_Web=:web,
        Game_Descript=:descript 
         WHERE Game_ID = :id", $params);

        if ($sqlSelect) {
            return true;
        } else {
            return false;
        }
    }

    public function Remove()
    {
        global $db;

        $params = array(array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("DELETE FROM " . constant("db_prefix") . "module_games WHERE Game_ID = :id", $params);

        if ($sqlSelect) {
            return true;
        } else {
            return false;
        }
    }

    public function GameGroups()
    {
        global $db;
        $params = array(array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("SELECT GG_GroupID FROM " . constant("db_prefix") . "module_gamegroups WHERE GG_GameID = :id", $params);

        if ($sqlSelect) {
            $groups = array();
            foreach ($db->QueryData as $group) {
                $groups[] = $group["GG_GroupID"];
            }
            return $groups;
        } else {
            return array();
        }
    }

    public function GamesByGroups($groups, $now = false)
    {
        global $db;
        $games = array();

        if (!empty($groups)) {
            foreach ($groups as $group) {
                $params = array(array("code" => ":id", "value" => $group));
                $sqlSelect = $db->Query("SELECT GG_GameID FROM " . constant("db_prefix") . "module_gamegroups WHERE GG_GroupID = :id", $params);

                if ($sqlSelect) {
                    $data = $db->QueryData;
                    if (!empty($data)) {
                        foreach ($data as $game) {
                            $this->id = $game["GG_GameID"];
                            $info = $this->Info();
                            if ($now) {
                                if ($info["Game_Date"] >= strtotime("+1 day")) {
                                    $games[$game["GG_GameID"]] = $info["Game_Date"];
                                }
                            } else {
                                $games[$game["GG_GameID"]] = $info["Game_Date"];
                            }

                        }
                    }
                }
            }
        }
        if (!empty($games)) {
            asort($games);
        }

        return array_keys($games);
    }

    public function GameUpdateGroups($groups)
    {
        global $db;
        $return = 0;
        $params = array(array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("DELETE FROM " . constant("db_prefix") . "module_gamegroups WHERE GG_GameID = :id", $params);

        if ($sqlSelect) {
            foreach ($groups as $group) {
                $params = array(array("code" => ":gameID", "value" => $this->id), array("code" => ":groupID", "value" => $group));
                $sqlSelect = $db->Query("INSERT INTO " . constant("db_prefix") . "module_gamegroups (GG_GameID, GG_GroupID) VALUES (:gameID,:groupID)", $params);
                if (!$sqlSelect) {
                    $return++;
                }
            }
            if ($return == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function AddAttendance($type, $user, $game, $apology = "")
    {
        global $db;

        $params = array(
            array("code" => ":type", "value" => $type),
            array("code" => ":id", "value" => $game),
            array("code" => ":user", "value" => $user),
            array("code" => ":apology", "value" => $apology),
            array("code" => ":change", "value" => strtotime("now")),
        );
        $sqlSelect = $db->Query("INSERT INTO " . constant("db_prefix") . "module_gameattendance
         (GA_UserID, GA_GameID,GA_Apologies,GA_Answer,GA_Status,GA_StatusChange)
          VALUES
          (:user, :id,:apology,:type,0,:change);",
            $params
        );

        if ($sqlSelect) {
            return true;
        } else {
            return false;
        }
    }

    public function ChangeStatusAttendance($game, $user, $type, $admin)
    {
        global $db;

        $params = array(
            array("code" => ":game", "value" => $game),
            array("code" => ":user", "value" => $user),
            array("code" => ":type", "value" => $type),
            array("code" => ":admin", "value" => $admin),
            array("code" => ":date", "value" => strtotime("now")));
        $sqlSelect = $db->Query("UPDATE " . constant("db_prefix") . "module_gameattendance SET GA_Status=:type,GA_AdminUserID=:admin,GA_StatusChange=:date WHERE GA_UserID = :user AND GA_GameID = :game", $params);

        if ($sqlSelect) {
            return true;
        } else {
            return false;
        }
    }

    public function GetAttendance()
    {
        global $db;

        $params = array(array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("SELECT * FROM " . constant("db_prefix") . "module_gameattendance WHERE GA_GameID = :id ORDER BY GA_Answer", $params);

        if ($sqlSelect) {
            return $db->QueryData;

        } else {
            return false;
        }
    }

    public function ControllAttendance($userID)
    {
        global $db;

        $params = array(array("code" => ":user", "value" => $userID), array("code" => ":id", "value" => $this->id));
        $sqlSelect = $db->Query("SELECT GA_Answer, GA_Status FROM " . constant("db_prefix") . "module_gameattendance WHERE GA_UserID = :user AND GA_GameID = :id LIMIT 1", $params);

        if ($sqlSelect) {
            return $db->QueryData[0];

        } else {
            return false;
        }
    }
    public function ControllAttendanceComplete($userID, $gameID)
    {
        global $db;

        $params = array(array("code" => ":user", "value" => $userID), array("code" => ":game", "value" => $gameID));
        $sqlSelect = $db->Query("SELECT GA_Answer FROM " . constant("db_prefix") . "module_gameattendance WHERE GA_UserID = :user AND GA_GameID = :game AND GA_Answer = 1 AND GA_Status = 1  LIMIT 1", $params);

        if ($sqlSelect) {
            return $db->QueryData[0];

        } else {
            return false;
        }
    }

    public function UserAttandace($userID, $type)
    {
        global $db;

        if($type == "a"){
            $answare = 1;
            $status = 1;
        } else {
            $answare = 2;
            $status = 0;
        }

        $params = array(
            array("code" => ":user", "value" => $userID),
            array("code" => ":status", "value" => $status),
            array("code" => ":answare", "value" => $answare)
        );
        $sqlSelect = $db->Query("SELECT COUNT(*) FROM " . constant("db_prefix") . "module_gameattendance WHERE GA_UserID = :user AND GA_Answer = :answare AND GA_Status = :status
        ", $params);

        if ($sqlSelect) {
            return $db->QueryData[0];
        } else {
            return false;
        }
    }

    public function RemoveAttendance($userID, $gameID)
    {
        global $db;

        $params = array(array("code" => ":user", "value" => $userID), array("code" => ":id", "value" => $gameID));
        $sqlSelect = $db->Query("DELETE FROM " . constant("db_prefix") . "module_gameattendance WHERE GA_UserID = :user AND GA_GameID = :id", $params);

        if ($sqlSelect) {
            return true;
        } else {
            return false;
        }
    }

    /* -------------------------------------- */
}
?>