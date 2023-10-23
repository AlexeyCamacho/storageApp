<?php

namespace App\Services;

use App\Models\Boxes\AppleBox;
use App\Models\Boxes\OrangesBox;
use App\Models\Boxes\PearsBox;
use Illuminate\Database\Eloquent\Model;

class BoxService
{
    public function getBoxes(int $count, $type)
    {
        if ($type == 'apple') {
            return AppleBox::limit($count)->get()->all();
        } else if ($type == 'pear') {
            return PearsBox::limit($count)->get()->all();
        } else if ($type == 'orange') {
            return OrangesBox::limit($count)->get()->all();
        }

        return null;
    }
}
