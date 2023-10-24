<?php

namespace App\Services;

use App\Models\Room;

class RoomService
{
    public function findRoom(array|int $keys)
    {
        return Room::find($keys);
    }
}
