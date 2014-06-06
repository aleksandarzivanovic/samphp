<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'tmp/a_http.php';
require_once 'tmp/a_npc.php';
require_once 'tmp/a_players.php';

require_once 'lib/player.php';
require_once 'lib/core/events.php';
require_once 'lib/core/colors.php';

Events::init(Events::GAMEMODE_INIT);

function OnGameModeInit() {
    Events::init(Events::PLAYER_CONNECT);
    Events::init(Events::PLAYER_DISCONNECT);

    Events::fire(Events::GAMEMODE_INIT);
}

function OnGameModeExit() {
    Events::fire(Events::GAMEMODE_EXIT);
}

function OnPlayerConnect($playerid) {
    Events::fire(Events::PLAYER_CONNECT, $playerid);
}

function OnPlayerDisconnect($playerid, $reason) {
    Events::fire(Events::PLAYER_DISCONNECT, $playerid, $reason);
}

function OnPlayerCommandText($playerid, $text) {
    Events::fire(Events::PLAYER_COMMAND, $playerid, $text);
}
