<?php

    require_once 'tmp/a_http.php';
    require_once 'tmp/a_npc.php';
    require_once 'tmp/a_players.php';
    
    require_once 'lib/player.php';
    
    function OnPlayerConnect($playerid) {
        /* @var $player Player */
        $player = Player::getPlayer($playerid);
        $player->x = 0.0;
        $player->y = 0.0;
        $player->z = 13.0;
    }