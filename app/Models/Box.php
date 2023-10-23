<?php

namespace App\Models;

use App\Interfaces\BoxInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parental\HasChildren;

class Box extends Model implements BoxInterface
{
    use HasFactory, HasChildren;

    protected $fillable = [
        'room_id',
        'type'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function exportBox(): void
    {
        $this->delete();
    }
}
