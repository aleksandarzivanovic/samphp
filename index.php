<?php

    require_once 'tmp/a_http.php';
    require_once 'tmp/a_npc.php';
    require_once 'tmp/a_players.php';
    
    require_once 'lib/player.php';
    
    function OnPlayerConnect($playerid) {
        /* @var $player Player */
        $player = Player::getPlayer($playerid);
        // This will return current X coord
        $x = $player->x;
        // This will change player to new X coord
        $player->x = $x + 10.0;
        
        // This will return player health
        if ($player->health < 30) {
            // This will set player health to 30
            $player->health = 30;
        }
    }