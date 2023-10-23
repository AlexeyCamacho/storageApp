<?php

namespace App\Http\Controllers;

use App\Services\BoxService;
use App\Services\FruitsBoxStorage;
use App\Services\StorageService;
use http\Env\Response;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class BoxesController extends Controller
{

    private StorageService $storageService;
    private BoxService $boxService;

    public function __construct()
    {
        $this->storageService = new FruitsBoxStorage();
        $this->boxService = new BoxService();

    }

    public function importBoxes(Request $request)
    {
        foreach ($request->only('data') as $key => $value) {
            $this->storageService->createBoxes($value, $key);
        }
    }

    public function exportBoxes(Request $request)
    {
        $exportBoxes = [];
        foreach ($request->only('data') as $key => $value) {
            $boxes = $this->boxService->getBoxes($value, $key);
            if (count($boxes) < $value) {
                abort(422, 'Недостаточно ящиков ' . $key . ' на складе.');
            }
            $exportBoxes = array_merge($exportBoxes, $boxes);
        }

        $this->storageService->exportBoxes($exportBoxes);
    }

    public function moveBoxes(Request $request)
    {
        $data = $request->only('data');
        $this->storageService->moveBoxes($data['room'], $data['boxes']);
    }
}
