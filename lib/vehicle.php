<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vehicle {

    public static $vehicles;
    public $vehicleId;
    public $x;
    public $y;
    public $z;
    public $rot;


    #
    private $onChange = array(
        'x' => array('setPos', 'getPos'),
        'y' => array('setPos', 'getPos'),
        'z' => array('setPos', 'getPos'),
        'rot' => array('setRot', 'getRot'),
    );

    #

    private function setPos() {
        return SetVehiclePos($this->vehicleId, $this->x, $this->y, $this->z);
    }

    private function getPos() {
        return GetVehiclePos($this->vehicleId);
    }

    private function setRot() {
        if (!is_numeric($this->rot)) {
            return null;
        }

        return SetVehicleZAngle($this->vehicleId, $this->rot);
    }

    private function getRot() {
        return GetVehicleZAngle($this->vehicleId);
    }

    public function __set($var, $val) {
        if (!$this->validVehicle()) {
            return null;
        }

        if ($var != 'vehicleId' && $var != 'onChange') {
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

        if ($this->validVehicle() && isset($this->$var)) {
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

    public function __construct($vehicleid) {
        $this->vehicleId = $vehicleid;
    }

    public static function createVehicle($modelid) {
        $vehicleid =  CreateVehicle($modelid, 0.0, 0.0, 0.0, 0.0, 0, 0, 60);
        return self::getVehicle($vehicleid);
    }
    
    public static function getVehicle($vehicleid) {
        if (IsValidVehicle($vehicleid)) {
            if (!self::$vehicles[$vehicleid]) {
                self::$vehicles[$vehicleid] = new self($vehicleid);
            }

            return self::$vehicles[$vehicleid];
        } else {
            return false;
        }
    }

}
