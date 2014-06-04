samphp
======

PHP framework for SAMP PHP plugin

Less function calling, more variables changing.

``` php
// This will create new or load existing
// instance for player id 1
$player = Player::getPlayer(1);

// This will get current X coordinate
$x = $player->x;

// This will change current X coordinate
// and move player to new X, same Y and same Z coordinates
$player->x = 10.0;

```
