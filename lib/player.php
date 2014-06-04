<?php

class Player {

    public static $players;
    public $playerId = -1;
    private $onChange = array(
        'x' => array('setPos', 'getPos'),
        'y' => array('setPos', 'getPos'),
        'z' => array('setPos', 'getPos'),
        'rot' => array('setFacingAngle', 'getFacingAngle'),
        'int' => array('setInterior', 'getInterior'),
        'vw' => array('setVirtualWorld', 'getVirtualWorld'),
        'health' => array('setHealth', 'getHealth'),
        'armour' => array('setArmour', 'getArmour'),
        'team' => array('setTeam', 'getTeam'),
        'weapon_state' => array('', 'getWeaponState'),
        'target' => array('', 'getTarget')
    );
    public $x = 0.0;
    public $y = 0.0;
    public $z = 0.0;
    public $rot = 0.0;
    public $int = 0;
    public $vw = 0;
    public $health = 100.0;
    public $armour = 0.0;
    public $weapon_state = -1;
    public $target = -1;
    public $team = 0;

    public function __construct($playerid = -1) {
        $this->playerId = $playerid;
    }

    public function __set($var, $val) {
        if (!$this->validPlayer()) {
            return null;
        }

        if (isset($this->$var) && $var != 'playerId' && $var != 'onChange') {
            if (array_key_exists($var, $this->onChange)) {
                $this->$var = $val;

                $function = $this->onChange[$var][0];
                if (strlen($function)) {
                    $this->$function();
                }
            }
        }
    }

    public function __get($var) {

        if (!$this->validPlayer()) {
            return null;
        }

        if (isset($this->$var)) {
            if (array_key_exists($var, $this->onChange)) {
                $function = $this->onChange[$var][1];

                if (!strlen($function)) {
                    return $this->$var;
                }

                $return = $this->$function();

                if (isset($return[$var])) {
                    return $return[$var];
                } else {
                    return $return;
                }
            } else {
                return $this->$var;
            }
        } else {
            return null;
        }
    }

    private function setTeam() {
        return SetPlayerTeam($this->playerId, $this->team);
    }

    private function getTeam() {
        return GetPlayerTeam($this->playerId);
    }

    private function getTarget() {
        return GetPlayerTargetPlayer($this->playerId);
    }

    private function getWeaponState() {
        return GetPlayerWeaponState($this->playerId);
    }

    private function setArmour() {

        if (is_numeric($this->armour)) {
            return SetPlayerArmour($this->playerId, $this->armour);
        } else {
            return false;
        }
    }

    private function getArmour() {
        $armour = 0.0;
        GetPlayerArmour($this->playerId, $armour);

        return $armour;
    }

    private function setHealth() {
        if (is_numeric($this->health)) {
            return SetPlayerHealth($this->playerId, $this->health);
        } else {
            return false;
        }
    }

    private function getHealth() {
        $health = 100.0;
        GetPlayerHealth($this->playerId, $health);

        return $health;
    }

    private function setInterior() {
        if (is_numeric($this->int)) {
            return SetPlayerInterior($this->playerId, $this->int);
        } else {
            return false;
        }
    }

    private function getInterior() {
        return GetPlayerInterior($this->playerId);
    }

    private function setVirtualWorld() {
        if (is_numeric($this->vw)) {
            return SetPlayerVirtualWorld($this->playerId, $this->vw);
        }
    }

    private function getVirtualWorld() {
        return GetPlayerVirtualWorld($this->playerId);
    }

    private function setFacingAngle() {
        if (is_numeric($this->rot)) {
            return SetPlayerFacingAngle($this->playerId, $this->rot);
        } else {
            return false;
        }
    }

    private function getFacingAngle() {
        $rot = 0.0;

        GetPlayerFacingAngle($this->playerId, $rot);
        return $rot;
    }

    private function setPos() {
        $x = $this->x;
        $y = $this->y;
        $z = $this->z;

        if (is_numeric($x) && is_numeric($y) && is_numeric($z)) {
            return SetPlayerPos($this->playerId, $x, $y, $z);
        } else {
            return false;
        }
    }

    private function getPos() {
        $data = array();
        GetPlayerPos($this->playerId, $data['x'], $data['y'], $data['z']);

        return $data;
    }

    private function validPlayer() {
        return ($this->playerId != -1 && IsPlayerConnected($this->playerId));
    }

    public static function getPlayer($playerid) {
        if (IsPlayerConnected($playerid)) {
            if (!self::$players[$playerid] ||
                    (self::$players[$playerid] && !IsPlayerConnected($playerid))) {
                self::$players[$playerid] = new self($playerid);
            }

            return self::$players[$playerid];
        } else {
            return false;
        }
    }

}
