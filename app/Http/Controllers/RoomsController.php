<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RoomsController extends Controller
{
    public function getRooms(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Cache::remember('rooms', 300, function () {
            return Room::query()
                ->with(['boxes' => function ($query) {
                    $query->select('room_id', 'type');
                }])
                ->get(['id', 'name']);
        });
    }
}
