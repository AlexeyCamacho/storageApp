<?php

namespace App\Models\Boxes;

use App\Models\Box;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class OrangesBox extends Box
{
    use HasFactory, HasParent;
}
