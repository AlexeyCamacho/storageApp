<?php

namespace App\Http\Controllers;

use App\Services\BoxService;
use App\Services\FruitsBoxStorage;
use App\Services\RoomService;
use App\Services\StorageService;
use Illuminate\Http\Request;

class BoxesController extends Controller
{

    private StorageService $storageService;
    private BoxService $boxService;
    private RoomService $roomService;

    public function __construct()
    {
        $this->storageService = new FruitsBoxStorage();
        $this->boxService = new BoxService();
        $this->roomService = new RoomService();
    }

    public function importBoxes(Request $request)
    {
        foreach ($request->input('data') as $key => $value) {
            $this->storageService->createBoxes($value, $key);
        }

        return true;
    }

    public function exportBoxes(Request $request)
    {
        $exportBoxes = [];
        foreach ($request->input('data') as $key => $value) {
            $boxes = $this->boxService->getBoxes($value, $key);
            if (count($boxes) < $value) {
                abort(422, 'Недостаточно ящиков ' . $key . ' на складе.');
            }
            $exportBoxes = array_merge($exportBoxes, $boxes);
        }

        $this->storageService->exportBoxes($exportBoxes);

        return true;
    }

    public function moveBoxes(Request $request)
    {
        $data = $request->only('data');
        $roomTo = $this->roomService->findRoom($data['room']);
        $boxes = $this->boxService->getBoxesById($data['boxes']);
        $this->storageService->moveBoxes($roomTo, $boxes);
    }
}
