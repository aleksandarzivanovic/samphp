<?php

class Player {

    public static $players;
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
    public $score = 0;
    public $drunk = 0;
    public $color = 0;
    public $skin = 299;
    public $armed_weapon = 0;
    public $name = 'John_Doe';
    public $current_ammo = 0;
    public $money = 0;
    public $state = 0;
    public $show_clock = 1;
    public $weather = 0;
    public $wanted_level = 0;
    public $figth_style = 0;
    public $controls = 1;
    public $surfing_vehicle = -1;
    public $surfing_object = -1;

    #
    private $playerId = -1;
    private $onChange = array(
        'x' => array('setPos', 'getPos'),
        'y' => array('setPos', 'getPos'),
        'z' => array('setPos', 'getPos'),
        'rot' => array('setFacingAngle', 'getFacingAngle'),
        'int' => array('setInterior', 'getInterior'),
        'vw' => array('setVirtualWorld', 'getVirtualWorld'),
        'health' => array('setHealth', 'getHealth'),
        'armour' => array('setArmour', 'getArmour'),
        'weapon_state' => array('', 'getWeaponState'),
        'target' => array('', 'getTarget'),
        'team' => array('setTeam', 'getTeam'),
        'score' => array('setScore', 'getScore'),
        'drunk' => array('setDrunk', 'getDrunk'),
        'color' => array('setColor', 'getColor'),
        'skin' => array('setSkin', 'getSkin'),
        'armed_weapon' => array('setArmed', 'getArmed'),
        'name' => array('setName', 'getName'),
        'current_ammo' => array('', 'getAmmo'),
        'money' => array('setMoney', 'getMoney'),
        'state' => array('', 'getState'),
        'show_clock' => array('setClock', 'getClock'),
        'weather' => array('setWeather', 'getWeather'),
        'wanted_level' => array('setWanted', 'getWanted'),
        'figth_style' => array('setFStyle', 'getFStyle'),
        'controls' => array('setControls', 'getControls'),
        'surfing_vehicle' => array('', 'getSurfingVehicle'),
        'surfing_object' => array('', 'getSurfingObject')
    );

    #

    public function __construct($playerid = -1) {
        $this->playerId = $playerid;
    }

    public function getId() {
        return $this->playerId;
    }

    public function showDialog($dialogid) {
        return Dialog::show($this->playerId, $dialogid);
    }

    public function ban() {
        return Ban($this->playerId);
    }

    public function kick() {
        return Kick($this->playerId);
    }

    public function spawn() {
        return SpawnPlayer($this->playerId);
    }

    public function sendMessage($string, $color) {
        if ($this->validPlayer()) {
            return SendClientMessage($this->playerId, $color, $string);
        } else {
            return NULL;
        }
    }

    private function getSurfingVehicle() {
        return GetPlayerSurfingVehicleID($this->playerId);
    }

    private function getSurfingObject() {
        return GetPlayerSurfingObjectID($this->playerId);
    }

    private function setControls() {
        return TogglePlayerControllable($this->playerId, $this->controls);
    }

    private function getControls() {
        return $this->controls;
    }

    private function setFStyle() {
        return SetPlayerFightingStyle($this->playerId, $this->figth_style);
    }

    private function getFStyle() {
        return GetPlayerFightingStyle($this->playerId);
    }

    private function setWanted() {
        return SetPlayerWantedLevel($this->playerId, $this->wanted_level);
    }

    private function getWanted() {
        return GetPlayerWantedLevel($this->playerId);
    }

    private function setWeather() {
        return SetPlayerWeather($this->playerId, $this->weather);
    }

    private function getWeather() {
        return $this->weather;
    }

    private function setClock() {
        return TogglePlayerClock($this->playerId, $this->show_clock);
    }

    private function getClock() {
        return $this->show_clock;
    }

    private function getState() {
        return GetPlayerState($this->playerId);
    }

    private function setMoney() {
        $money = GetPlayerMoney($this->playerId);

        return GivePlayerMoney($this->playerId, $money + $this->money);
    }

    private function getMoney() {
        return GetPlayerMoney($this->playerId);
    }

    private function getAmmo() {
        return GetPlayerAmmo($this->playerId);
    }

    private function setName() {
        return SetPlayerName($this->playerId, $this->name);
    }

    private function getName() {
        return GetPlayerName($this->playerId);
    }

    private function setArmed() {
        return SetPlayerArmedWeapon($this->playerId, $this->armed_weapon);
    }

    private function getArmed() {
        return GetPlayerWeapon($this->playerId);
    }

    private function setDrunk() {
        return SetPlayerDrunkLevel($this->playerId, $this->drunk);
    }

    private function getDrunk() {
        return GetPlayerDrunkLevel($this->playerId);
    }

    private function setColor() {
        return SetPlayerColor($this->playerId, $this->color);
    }

    private function getColor() {
        return GetPlayerColor($this->playerId);
    }

    private function setSkin() {
        return SetPlayerSkin($this->playerId, $this->skin);
    }

    private function getSkin() {
        return GetPlayerSkin($this->playerId);
    }

    private function setScore() {
        return SetPlayerScore($this->playerId, $this->score);
    }

    private function getScore() {
        return GetPlayerScore($this->playerId);
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
        $armour = GetPlayerArmour($this->playerId);

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
        $health = GetPlayerHealth($this->playerId);

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
        $rot = GetPlayerFacingAngle($this->playerId);
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
        $data = GetPlayerPos($this->playerId);

        return $data;
    }

    private function validPlayer() {
        return ($this->playerId != -1 && IsPlayerConnected($this->playerId));
    }

    public function __set($var, $val) {
        if (!$this->validPlayer()) {
            return null;
        }

        if ($var != 'playerId' && $var != 'onChange') {
            $this->$var = $val;

            if (array_key_exists($var, $this->onChange)) {

                $function = $this->onChange[$var][0];
                if (strlen($function)) {
                    $this->$function();
                }
            }
        }
    }

    public function __get($var) {

        if ($this->validPlayer() && isset($this->$var)) {
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
