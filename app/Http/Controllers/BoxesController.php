<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportExportBoxesRequest;
use App\Http\Requests\MoveBoxesRequest;
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

    public function importBoxes(ImportExportBoxesRequest $request): void
    {
        foreach ($request->input('data') as $key => $value) {
            $this->storageService->createBoxes($value, $key);
        }
    }

    public function exportBoxes(ImportExportBoxesRequest $request): void
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
    }

    public function moveBoxes(MoveBoxesRequest $request): void
    {
        $moveBoxes = [];
        $data = $request->input('data');
        $roomTo = $this->roomService->findRoom($data['to']);

        foreach ($data['countBoxes'] as $key => $value) {
            $boxes = $this->boxService->getBoxes($value, $key, $data['from']);
            if (count($boxes) < $value) {
                abort(422, 'Недостаточно ящиков ' . $key . ' в помещении.');
            }
            $moveBoxes = array_merge($moveBoxes, $boxes);
        }

        $this->storageService->moveBoxes($roomTo, $moveBoxes);
    }
}
