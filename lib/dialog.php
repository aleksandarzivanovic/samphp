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

    public static function add($name, $style, $caption, $b1, $b2) {
        if ($style < self::STYLE_MSGBOX || $style > self::STYLE_PASSWORD || !strlen($b1)) {
            return false;
        }

        $b2 = (strlen($b2) > 0 ? $b2 : '');
        $caption = (strlen($caption) > 0 ? $caption : '');
        self::$dialogs[$name] = array(
            'style' => $style,
            'caption' => $caption,
            'button1' => $b1,
            'button2' => $b2
        );
    }

}
