<?php

namespace Database\Factories;

use App\Interfaces\BoxFactory;
use App\Models\Boxes\AppleBox;
use App\Models\Boxes\OrangesBox;
use App\Models\Boxes\PearsBox;

class FruitsBoxFactory implements BoxFactory
{
    public function createBoxes(int $count, string $type): array
    {
        $boxes = [];

        for ($i = 0; $i < $count; $i++) {
            $boxes[] = $this->createBox($type);
        }

        return $boxes;

    }

    public function createBox(string $type)
    {
        if ($type == 'apple') {
            return $this->createAppleBox();
        } else if ($type == 'pear') {
            return $this->createPearsBox();
        } else if ($type == 'orange') {
            return $this->createOrangesBox();
        }
    }
    public function createAppleBox(): AppleBox
    {
        return new AppleBox();
    }

    public function createPearsBox(): PearsBox
    {
        return new PearsBox();
    }

    public function createOrangesBox(): OrangesBox
    {
        return new OrangesBox();
    }
}
