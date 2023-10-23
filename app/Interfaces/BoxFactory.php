<?php

namespace App\Interfaces;

interface BoxFactory
{
    public function createAppleBox();
    public function createPearsBox();
    public function createOrangesBox();
    public function createBoxes(int $count, string $type);
}
