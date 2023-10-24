<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\FruitsBoxStorage;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function test()
    {
        $service = new FruitsBoxStorage();
        $data = ['apple' => 4, 'pear' => 2, 'orange' => 12];

        foreach ($data as $key => $value) {
            $service->createBoxes($value, $key);
        }
        $exportBoxes = [];
        foreach ($data as $key => $value) {
            $boxes = $service->getBoxes($value, $key);
            if (count($boxes) < $value) {
                abort(422, 'Недостаточно ящиков ' . $key . ' на складе.');
            }
            $exportBoxes = array_merge($exportBoxes, $boxes);
        }

        //$service->moveBoxes(Room::find(1), $exportBoxes);

        //$service->exportBoxes($exportBoxes);
    }
}
