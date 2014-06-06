<?php

class Events {

    public static $events;

    const PLAYER_CONNECT = 10001;
    const PLAYER_DISCONNECT = 10002;
    const PLAYER_COMMAND = 10003;
    
    const GAMEMODE_INIT = 20001;
    const GAMEMODE_EXIT = 20002;

    public static function add($function = null, $callback = null) {
        if (is_int($function) && is_callable($callback)) {
            self::$events[$function][] = $callback;
        }

        return this;
    }

    public static function fire($function = null) {

        $args = func_get_args();
        unset($args[0]);

        if (!is_int($function) || empty(self::$events[$function])) {
            return this;
        }

        $events = self::$events[$function];
        foreach ($events as $event) {
            call_user_func_array($event, $args);
        }

        return true;
    }

    public static function init($function = null) {
        if (!is_int($function)) {
            return this;
        }

        if (!self::$events[$function]) {
            self::$events[$function] = array();
        }
    }

}
