<?php

namespace App\Services;

use App\Interfaces\BoxFactory;
use App\Interfaces\BoxInterface;
use App\Interfaces\RoomInterface;

abstract class StorageService
{
    /**
     * @var RoomInterface[]
     */
    private array $rooms;
    protected BoxFactory $factory;

    /**
     * @param RoomInterface[] $rooms
     */
    public function __construct(array $rooms, BoxFactory $factory)
    {
        $this->rooms = $rooms;
        $this->factory = $factory;
    }

    /**
     * @param BoxInterface[] $boxes
     * @return void
     */
    public function importBoxes(array $boxes): void
    {
        $room = $this->getMinLoadRoom();
        if ($room) {
            $room->import($boxes);
        }
    }

    public function createBoxes(int $count, string $type): void
    {
        $boxes = $this->factory->createBoxes($count, $type);
        $this->importBoxes($boxes);
    }

    public function moveBoxes($room, array $boxes)
    {
        $room->import($boxes);
    }

    /**
     * @param BoxInterface[] $boxes
     * @return void
     */
    public function exportBoxes(array $boxes): void
    {
        foreach ($boxes as $box) {
            $box->exportBox();
        }
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
