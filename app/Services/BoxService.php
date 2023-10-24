<?php

namespace App\Services;

use App\Models\Box;
use App\Models\Boxes\AppleBox;
use App\Models\Boxes\OrangesBox;
use App\Models\Boxes\PearsBox;
use Illuminate\Database\Eloquent\Model;

class BoxService
{
    public function getBoxes(int $count, $type, int $room = null)
    {
        if ($type == 'apple') {
            return AppleBox::limit($count)
                ->when($room, function ($query) use ($room) {
                    return $query->where('room_id', $room);
                })
                ->get()->all();
        } else if ($type == 'pear') {
            return PearsBox::limit($count)
                ->when($room, function ($query) use ($room) {
                    return $query->where('room_id', $room);
                })
                ->get()->all();
        } else if ($type == 'orange') {
            return OrangesBox::limit($count)
                ->when($room, function ($query) use ($room) {
                    return $query->where('room_id', $room);
                })
                ->get()->all();
        }

        return null;
    }

    public function getBoxesById(array|int $id)
    {
        return Box::find($id);
    }
}
