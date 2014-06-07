<?php

include './lib/core/core.php';
include './dialogs.php';

Events::add(Events::PLAYER_CONNECT, function ($playerid) {
    /* @var $p Player */
    $p = Player::getPlayer($playerid);

    $msg = 'Hello ' . $p->name . ' welcome to our PHP server';
    $p->sendMessage($msg, Color::yellow);


    if (!file_exists('/Players/' . $p->name . '.cfg')) {
        $dialogid = DIALOG_REGISTER;
    } else {
        $dialogid = DIALOG_LOGIN;
    }

    $p->showDialog($dialogid);
});

Events::add(Events::PLAYER_SPAWN, function ($playerid) {
    /* @var $p Player */
    $p = Player::getPlayer($playerid);

    if ($p->health < 30) {
        $p->health = 30;
    }

    // jailed is custom
    // customs will be done soon
    if ($p->jailed) {
        $p->controls = 0;
        $p->x = 123.00;
        $p->y = 225.00;
        $p->z = 1014.33;
        sleep(3);
        $p->controls = 1;
    }

    if ($p->wanted_level) {
        $p->sendMessage('You have wanted level ' . $p->wanted_level, Color::blue);
    }
});
