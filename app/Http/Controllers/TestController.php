<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\FruitsBoxStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    //

    public function test()
    {
        $value = Cache::get('rooms');
        return $value;
    }
}
