<?php

class Player {

    public static $players;
    public $playerId = -1;
    private $onChange = array(
        'x' => array('setPos', 'getPos'),
        'y' => array('setPos', 'getPos'),
        'z' => array('setPos', 'getPos'),
        'rot' => array('setFacingAngle', 'getFacingAngle')
    );
    private $x = 0.0;
    private $y = 0.0;
    private $z = 0.0;
    private $rot = 0.0;

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

    private function setFacingAngle() {
        if ($this->playerValid()) {
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
        if ($this->playerValid()) {
            $rot = 0.0;
            
            GetPlayerFacingAngle($this->playerId, $rot);
            return array('rot' => $rot);
        } else {
            return null;
        }
    }

    private function setPos() {
        if ($this->playerValid()) {
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
        if ($this->playerValid()) {

            $x = 0.0;
            $y = 0.0;
            $z = 0.0;

            GetPlayerPos($this->playerId, $x, $y, $z);

            $data = array(
                'x' => $x,
                'y' => $y,
                'z' => $z
            );

            return $data;
        }

        return null;
    }

    private function playerValid() {
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
