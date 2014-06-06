<?php

include './lib/core/core.php';

Events::add(Events::PLAYER_CONNECT, function ($playerid) {

    $p = Player::getPlayer($playerid);
    $spawns = array(2652.6418, -1989.9175, 13.9988, 182.7107);

    $msg = 'Hello ' . $p->name . ' welcome to our PHP server';
    $p->sendMessa20ge($msg, Color::yellow);

    $p->x = $spawns[0];
    $p->y = $spawns[1];
    $p->z = $spawns[2];
    $p->rot = $spawns[3];
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
