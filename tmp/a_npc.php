<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function CreateObject($modelid, $X, $Y, $Z, $rX, $rY, $rZ, $DrawDistance = 0.0) {}
function AttachObjectToVehicle($objectid, $vehicleid, $OffsetX, $OffsetY, $OffsetZ, $RotX, $RotY, $RotZ) {}
function AttachObjectToObject($objectid, $attachtoid, $OffsetX, $OffsetY, $OffsetZ, $RotX, $RotY, $RotZ, $SyncRotation = 1) {}
function AttachObjectToPlayer($objectid, $playerid, $OffsetX, $OffsetY, $OffsetZ, $RotX, $RotY, $RotZ) {}
function SetObjectPos($objectid, $X, $Y, $Z) {}
function GetObjectPos($objectid, &$X, &$Y, &$Z) {}
function SetObjectRot($objectid, $RotX, $RotY, $RotZ) {}
function GetObjectRot($objectid, &$RotX, &$RotY, &$RotZ) {}
function IsValidObject($objectid) {}
function DestroyObject($objectid) {}
function MoveObject($objectid, $X, $Y, $Z, $Speed, $RotX = -1000.0, $RotY = -1000.0, $RotZ = -1000.0) {}
function StopObject($objectid) {}
function IsObjectMoving($objectid) {}
function EditObject($playerid, $objectid) {}
function EditPlayerObject($playerid, $objectid) {}
function SelectObject($playerid) {}
function CancelEdit($playerid) {}
function CreatePlayerObject($playerid, $modelid, $X, $Y, $Z, $rX, $rY, $rZ, $DrawDistance = 0.0) {}
function AttachPlayerObjectToVehicle($playerid, $objectid, $vehicleid, $fOffsetX, $fOffsetY, $fOffsetZ, $fRotX, $fRotY, $RotZ) {}
function SetPlayerObjectPos($playerid, $objectid, $X, $Y, $Z) {}
function GetPlayerObjectPos($playerid, $objectid, &$X, &$Y, &$Z) {}
function SetPlayerObjectRot($playerid, $objectid, $RotX, $RotY, $RotZ) {}
function GetPlayerObjectRot($playerid, $objectid, &$RotX, &$RotY, &$RotZ) {}
function IsValidPlayerObject($playerid, $objectid) {}
function DestroyPlayerObject($playerid, $objectid) {}
function MovePlayerObject($playerid, $objectid, $X, $Y, $Z, $Speed, $RotX = -1000.0, $RotY = -1000.0, $RotZ = -1000.0) {}
function StopPlayerObject($playerid, $objectid) {}
function IsPlayerObjectMoving($playerid, $objectid) {}
function AttachPlayerObjHectToPlayer($objectplayer, $objectid, $attachplayer, $OffsetX, $OffsetY, $OffsetZ, $rX, $rY, $rZ) {}