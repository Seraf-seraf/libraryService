<?php

namespace Repository;

use Interface\Identifiable;
use SplObjectStorage;
use SplObserver;
use SplSubject;

abstract class Repository implements RepositoryInterface, SplSubject
{
    protected array $storage = [];
    private SplObjectStorage $observers;


    public function __construct(SplObserver $logger) {
        $this->observers = new SplObjectStorage();
        $this->observers->attach($logger);
    }

    public function add(Identifiable $identifiable): void
    {
        $this->storage[$identifiable->getId()] = $identifiable;
        $this->notify('Добавлен(-а): ', $identifiable);
    }

    public function findById(int|string $id)
    {
        $this->notify('Найден(-а): ', $this->storage[$id]);
        return $this->storage[$id] ?? [];
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify($event = '', $data = null): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this, ['event' => $event, 'data' => $data]);
        }
    }
}