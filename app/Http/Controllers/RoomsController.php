<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function getRooms(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Room::with('boxes')->get();
    }
}
