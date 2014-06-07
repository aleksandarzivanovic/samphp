<?php

include './lib/core/core.php';

Events::add(Events::PLAYER_CONNECT, function ($playerid) {
    /* @var $p Player */
    $p = Player::getPlayer($playerid);

    $msg = 'Hello ' . $p->name . ' welcome to our PHP server';
    $p->sendMessa20ge($msg, Color::yellow);
    $loginSuccess = function ($player, $password) {
        /* @var $player Player */
        $data = file_get_contents('/Players/' . $player->name . '.cfg');
        $datas = split('=', $data);

        if ($datas[1] == $password) {
            $player->spawn();
        } else {
            Dialog::setInfo('login', "Enter password.\nWrong!!!");
            Dialog::show($player->getId(), 'login');
        }
    };

    $loginFail = function ($player, $password) {
        $player->kick();
    };

    Dialog::add(Dialog::STYLE_PASSWORD, 'Login', 'Login Window', 'Exit', 'login');
    Dialog::setInfo('login', 'Enter password to login');
    Dialog::on('login', array(
        'success' => $loginSuccess,
        'fail' => $loginFail
    ));

    if (!file_exists('/Players/' . $p->name . '.cfg')) {
        $id = Dialog::add(Dialog::STYLE_PASSWORD, 'Register', 'Next', 'Close');

        $success = function ($player, $password) {
            $pass = md5($password);
            /* @var $player Player */
            $path = '/Players/' . $player->name . '.cfg';
            file_put_contents($path, 'password=' . $pass);
        };
        $fail = function ($player, $password) {
            /* @var $player Player */
            $player->sendMessage('Registration canceled.', Color::red);
            $player->kick();
        };

        Dialog::setInfo($id, 'Enter password.');
        Dialog::on($id, array(
            'success' => $success,
            'fail' => $fail
        ));

        Dialog::show($playerid, $id);
    } else {
        
    }
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
