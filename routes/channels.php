<?php

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

use Modules\Consulting\Models\Consulting;


Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('chat.{consultings_id}', function ($user, Consulting $consulting) {
//     return $user->clients_id === $consulting->clients_id;
// });

//  Broadcast::channel('my-channel.*', function ($client, $consultings_id) {
//     return $client->clients_id === Consulting::findOrNew($consultings_id)->clients_id;
// });