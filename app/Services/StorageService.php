<?php

namespace App\Services;

use App\Interfaces\BoxInterface;
use App\Interfaces\RoomInterface;

class StorageService
{
    /**
     * @var RoomInterface[]
     */
    private array $rooms;

    /**
     * @param RoomInterface[] $rooms
     */
    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * @param BoxInterface[] $boxes
     * @return void
     */
    public function importBoxes(array $boxes): void
    {
        $room = $this->getMinLoadRoom();
        $room->import($boxes);
    }

    private function getMinLoadRoom(): ?RoomInterface
    {
        $minRoom = null;
        $minLoad = -1;
        foreach ($this->rooms as $room) {
            $roomLoad = $room->countBoxes();

            if ($roomLoad < $minLoad || $minLoad == -1) {
                $minLoad = $roomLoad;
                $minRoom = $room;
            }
        }

        return $minRoom;
    }
}
