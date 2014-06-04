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
        'armour' => array('setArmour', 'getArmour')
    );
    private $x = 0.0;
    private $y = 0.0;
    private $z = 0.0;
    private $rot = 0.0;
    private $int = 0;
    private $vw = 0;
    private $health = 100.0;
    private $armour = 0.0;

    public function __construct($playerid = -1) {
        $this->playerId = $playerid;
    }

    public function __set($var, $val) {
        if (isset($this->$var) && $var != 'playerId' && $var != 'onChange') {
            $this->$var = $val;

            if (array_key_exists($var, $this->onChange)) {
                $function = $this->onChange[$var][0];
                $this->$function();
            }
        }
    }

    public function __get($var) {
        if (isset($this->$var)) {
            if (array_key_exists($var, $this->onChange)) {
                $function = $this->onChange[$var][1];
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

    private function setArmour() {
        if ($this->validPlayer()) {
            if (is_numeric($this->armour)) {
                return SetPlayerArmour($this->playerId, $this->armour);
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    private function getArmour() {
        if ($this->validPlayer()) {
            $armour = 0.0;
            GetPlayerArmour($this->playerId, $armour);

            return $armour;
        } else {
            return null;
        }
    }

    private function setHealth() {
        if ($this->validPlayer()) {
            if (is_numeric($this->health)) {
                return SetPlayerHealth($this->playerId, $this->health);
            } else {
                return false;
            }
        } else {
            return NULL;
        }
    }

    private function getHealth() {
        if ($this->validPlayer()) {
            $health = 100.0;
            GetPlayerHealth($this->playerId, $health);

            return $health;
        } else {
            return null;
        }
    }

    private function setInterior() {
        if ($this->validPlayer()) {
            if (is_numeric($this->int)) {
                return SetPlayerInterior($this->playerId, $this->int);
            }
        } else {
            return null;
        }
    }

    private function getInterior() {
        if ($this->validPlayer()) {
            return GetPlayerInterior($this->playerId);
        } else {
            return null;
        }
    }

    private function setVirtualWorld() {
        if ($this->validPlayer()) {
            if (is_numeric($this->vw)) {
                return SetPlayerVirtualWorld($this->playerId, $this->vw);
            }
        } else {
            return null;
        }
    }

    private function getVirtualWorld() {
        if ($this->validPlayer()) {
            return GetPlayerVirtualWorld($this->playerId);
        } else {
            return null;
        }
    }

    private function setFacingAngle() {
        if ($this->validPlayer()) {
            if (is_numeric($this->rot)) {
                return SetPlayerFacingAngle($this->playerId, $this->rot);
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    private function getFacingAngle() {
        if ($this->validPlayer()) {
            $rot = 0.0;

            GetPlayerFacingAngle($this->playerId, $rot);
            return $rot;
        } else {
            return null;
        }
    }

    private function setPos() {
        if ($this->validPlayer()) {
            $x = $this->x;
            $y = $this->y;
            $z = $this->z;

            if (is_numeric($x) && is_numeric($y) && is_numeric($z)) {
                return SetPlayerPos($this->playerId, $x, $y, $z);
            } else {
                return false;
            }
        }

        return null;
    }

    private function getPos() {
        if ($this->validPlayer()) {
            $data = array();
            GetPlayerPos($this->playerId, $data['x'], $data['y'], $data['z']);

            return $data;
        }

        return null;
    }

    private function validPlayer() {
        return ($this->playerId != -1 && IsPlayerConnected($this->playerId));
    }

    public static function getPlayer($playerid) {
        if (IsPlayerConnected($playerid)) {
            if (!self::$players[$playerid]) {
                self::$players[$playerid] = new self($playerid);
            }

            return self::$players[$playerid];
        } else {
            return false;
        }
    }

}
