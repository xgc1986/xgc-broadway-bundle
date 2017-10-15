<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Test\Stub;

use Broadway\Domain\DomainEventStream;
use Broadway\EventStore\EventStore;

/**
 * Class EventStoreStub
 *
 * @package Xgc\Common\Tests\Stub
 */
class EventStoreStub implements EventStore
{
    private $map = [];

    /**
     * @param mixed $id
     *
     * @return mixed|null
     */
    public function load($id)
    {
        return $this->map[$id] ?? null;
    }

    /**
     * @param mixed $id
     * @param int   $playhead
     *
     * @return mixed|null
     */
    public function loadFromPlayhead($id, $playhead)
    {
        return $this->map[$id] ?? null;
    }

    /**
     * @param mixed             $id
     * @param DomainEventStream $eventStream
     */
    public function append($id, DomainEventStream $eventStream): void
    {
        $this->map[$id] = $eventStream;
    }
}
