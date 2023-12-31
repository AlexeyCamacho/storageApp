<?php

namespace App\Models;

use App\Interfaces\RoomInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model implements RoomInterface
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class);
    }

    public function import(array $boxes): void
    {
        $this->boxes()->saveMany($boxes);
    }

    public function countBoxes(): int
    {
        return $this->boxes()->count();
    }

    public function exportBoxes(array $boxes): void
    {
        foreach ($boxes as $box) {
            $this->boxes()->delete($box->id);
        }
    }
}
