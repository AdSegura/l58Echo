<?php

use App\Broadcasting\ChatChannel;
use App\Broadcasting\ControlChannel;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('u2u.{chat}', ChatChannel::class);
Broadcast::channel('u.{id}', ControlChannel::class);
