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
require_once 'lib/dialog.php';
require_once 'lib/core/colors.php';

//Player Callbacks
Events::init(Events::PLAYER_CONNECT);
Events::init(Events::PLAYER_DISCONNECT);
Events::init(Events::PLAYER_COMMAND);
Events::init(Events::PLAYER_SPAWN);

// Server Callbacks
Events::init(Events::GAMEMODE_INIT);
Events::init(Events::GAMEMODE_EXIT);

function OnGameModeInit() {
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

function OnPlayerSpawn($playerid) {
    Events::fire(Events::PLAYER_SPAWN, $playerid);
}

function OnPlayerCommandText($playerid, $text) {
    Events::fire(Events::PLAYER_COMMAND, $playerid, $text);
}

function OnDialogResponse($playerid, $dialogid, $response, $listitem, $inputtext) {
    if ($response) {
        Dialog::success($playerid, $dialogid, $inputtext, $listitem);
    } else {
        Dialog::fail($playerid, $dialogid, $inputtext, $listitem);
    }
}
