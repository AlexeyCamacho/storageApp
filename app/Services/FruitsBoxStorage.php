<?php

namespace App\Services;

use App\Interfaces\BoxFactory;
use App\Models\Box;
use App\Models\Boxes\AppleBox;
use App\Models\Boxes\OrangesBox;
use App\Models\Boxes\PearsBox;
use App\Models\Room;
use Database\Factories\FruitsBoxFactory;

class FruitsBoxStorage extends StorageService
{
    public function __construct()
    {
        $rooms = Room::all()->all();
        parent::__construct($rooms, new FruitsBoxFactory());
    }

}
