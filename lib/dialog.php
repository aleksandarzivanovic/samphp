<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dialog {

    public static $dialogs;

    const STYLE_MSGBOX = 0;
    const STYLE_INPUT = 1;
    const STYLE_LIST = 2;
    const STYLE_PASSWORD = 3;

    public static function add($style, $caption, $b1, $b2, $id = FALSE) {
        if (!is_numeric($id) || strpos($id, '.') !== false) {
            return false;
        }

        if ($style < self::STYLE_MSGBOX || $style > self::STYLE_PASSWORD || !strlen($b1)) {
            return false;
        }

        $b2 = (strlen($b2) > 0 ? $b2 : '');
        $caption = (strlen($caption) > 0 ? $caption : '');
        self::$dialogs[$id] = array(
            'style' => $style,
            'caption' => $caption,
            'button1' => $b1,
            'button2' => $b2,
        );

        return $id;
    }

    public static function addRows($id, array $rows) {
        foreach ($rows as $key => $value) {
            $text[] = $key;
            $values[] = $value;
        }

        self::$dialogs[$id]['lines'] = $text;
        self::$dialogs[$id]['values'] = $values;

        return $id;
    }

    public static function setInfo($id, $info) {
        $info = (strlen($info) > 0 ? $info : '');
        self::$dialogs[$id]['info'] = $info;

        return $id;
    }

    public static function show($playerid, $id) {
        $style = self::$dialogs[$id]['style'];

        if ($style == self::STYLE_LIST) {
            $info = implode("\n", self::$dialogs[$id]['lines']);
        } else {
            $info = self::$dialogs[$id]['info'];
        }

        $caption = self::$dialogs[$id]['caption'];
        $button1 = self::$dialogs[$id]['button1'];
        $button2 = self::$dialogs[$id]['button2'];
        return ShowPlayerDialog($playerid, $id, $style, $caption, $info, $button1, $button2);
    }

    //Dialog::success($playerid, $dialogid, $inputtext, $listitem);
    public static function on($id, array $callbacks) {
        foreach ($callbacks as $callback => $function) {
            self::$dialogs[$id][$callback] = $function;
        }

        return $id;
    }

    public static function success($playerid, $id, $inputtext, $listitem) {
        $p = Player::getPlayer($playerid);
        $function = self::$dialogs[$id]['success'];

        if (self::$dialogs[$id]['style'] == self::STYLE_LIST) {
            $value = self::$dialogs[$id]['values'][$listitem];
        } else {
            $value = $inputtext;
        }

        call_user_func_array($function, [$p, $value]);

        return $id;
    }

    //Dialog::fail($playerid, $dialogid, $inputtext, $listitem);
    public static function fail($playerid, $id, $inputtext, $listitem) {
        $p = Player::getPlayer($playerid);
        $function = self::$dialogs[$id]['fail'];

        if (self::$dialogs[$id]['style'] == self::STYLE_LIST) {
            $value = self::$dialogs[$id]['values'][$listitem];
        } else {
            $value = $inputtext;
        }

        call_user_func_array($function, [$p, $value]);

        return $id;
    }

}
