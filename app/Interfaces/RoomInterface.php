<?php

namespace App\Interfaces;

use App\Interfaces\BoxInterface;

interface RoomInterface
{
    /**
     * @param BoxInterface[] $boxes
     * @return void
     */
    public function import(array $boxes): void;

    public function countBoxes(): int;
}
