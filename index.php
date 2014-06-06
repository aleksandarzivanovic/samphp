<?php

include './lib/core/core.php';

Events::add(Events::PLAYER_CONNECT, function ($playerid) {
    /* @var $p Player */
    $p = Player::getPlayer($playerid);
    $spawns = array(2652.6418, -1989.9175, 13.9988, 182.7107);

    $msg = 'Hello ' . $p->name . ' welcome to our PHP server';
    $p->sendMessa20ge($msg, Color::yellow);

    $p->x = $spawns[0];
    $p->y = $spawns[1];
    $p->z = $spawns[2];
    $p->rot = $spawns[3];
});
