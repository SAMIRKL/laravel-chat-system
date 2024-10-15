<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Room;


Broadcast::channel('users.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.room.{id}', function (User $user, $id) {
    // return (int) $user->id === (int) $id;
    if (Room::where('id', $id)->exists()) {
        return true;    // return (int) $user->id;
    }
    return false;
    // return $user->only('id', 'name');
});


Broadcast::channel('room.{id}', function (User $user, $id) {
    // return (int) $user->id === (int) $id;
    return $user->only('id', 'name');
});
// Broadcast::channel('mehrnaz', function () {
//     return true;
// });

