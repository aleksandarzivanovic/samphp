<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('DIALOG_LOGIN', 1);
define('DIALOG_REGISTER', 2);
define('DIALOG_TEAM', 3);

# LOGIN DIALOG
Dialog::add(Dialog::STYLE_PASSWORD, 'Login Window', 'Login', 'Exit', DIALOG_LOGIN);
Dialog::setInfo(DIALOG_LOGIN, 'Enter password to login');
$loginSuccess = function ($player, $password) {
    /* @var $player Player */
    $data = file_get_contents('/Players/' . $player->name . '.cfg');
    $datas = split('=', $data);

    if ($datas[1] == md5($password)) {
        $player->showDialog(DIALOG_TEAM);
    } else {
        Dialog::setInfo(DIALOG_LOGIN, "Enter password.\nWrong!!!");
        $player->showDialog(DIALOG_LOGIN);
    }
};

$loginFail = function ($player) {
    $player->kick();
};
Dialog::on(DIALOG_LOGIN, array(
    'success' => $loginSuccess,
    'fail' => $loginFail
));

# REGISTER DIALOG
Dialog::add(Dialog::STYLE_INPUT, 'Register', 'Next', 'Close', DIALOG_REGISTER);
Dialog::setInfo(DIALOG_REGISTER, 'Enter password.');
$success = function ($player, $password) {
    $pass = md5($password);
    /* @var $player Player */
    $path = '/Players/' . $player->name . '.cfg';
    file_put_contents($path, 'password=' . $pass);
    Events::fire(Events::PLAYER_CONNECT, $player->getId());
};
$fail = function ($player) {
    /* @var $player Player */
    $player->sendMessage('Registration canceled.', Color::red);
    $player->kick();
};
Dialog::on(DIALOG_REGISTER, array(
    'success' => $success,
    'fail' => $fail
));

# Team SELECT
Dialog::add(Dialog::STYLE_LIST, 'Team', 'Ok', 'Exit', DIALOG_TEAM);
Dialog::setInfo(DIALOG_TEAM, 'Select team.');
Dialog::addRows(DIALOG_TEAM, array(
    'Police' => 'Cop',
    'Badass' => 'Gang'
));
$teamSuccess = function ($player, $value) {
    /* @var $player Player */
    $player->team = ($value == 'Cop' ? 1 : 2);
    $msg = 'You are ' . $value . '[' . $player->team . ']';
    $player->sendMessage($msg, Color::yellow);
    $player->spawn();
};
$teamFail = function ($player) {
    /* @var $player Player */
    $player->kick();
};
Dialog::on(DIALOG_TEAM, array(
    'success' => $teamSuccess,
    'fail' => $teamFail
));
