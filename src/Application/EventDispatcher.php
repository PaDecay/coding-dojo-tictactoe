<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Event\Event;
use App\Domain\Event\EventListener;

final class EventDispatcher
{
    /** @var iterable<EventListener> $listeners */
    private iterable $listeners;

    /**
     * @param iterable<EventListener> $listeners
     */
    public function __construct(iterable $listeners)
    {
        $this->listeners = $listeners;
    }

    /**
     * @param iterable<Event> $events
     */
    public function dispatchAll(iterable $events): void
    {
        foreach ($events as $event) {
            foreach ($this->listeners as $listener) {
                $listener($event);
            }
        }
    }
}
