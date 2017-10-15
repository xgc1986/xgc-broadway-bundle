<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Repository;

use Broadway\Domain\AggregateRoot;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository as BaseEventSourcingRepository;
use Broadway\EventStore\EventStore;

/**
 * Class EventSourcingRepository
 *
 * @package Xgc\Common\Repository
 */
abstract class EventSourcingRepository
{
    /**
     * @var EventSourcingRepository
     */
    protected $eventSourceRepository;

    /**
     * AbstractESRepository constructor.
     *
     * @param EventStore $eventStore
     * @param EventBus   $eventBus
     */
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus
    ) {
        $this->eventSourceRepository = new BaseEventSourcingRepository(
            $eventStore,
            $eventBus,
            $this->aggregateClass(),
            new PublicConstructorAggregateFactory(),
            []
        );
    }

    /**
     * @return string
     */
    abstract protected function aggregateClass(): string;

    /**
     * @param string $id
     *
     * @return AggregateRoot
     */
    public function load(string $id): AggregateRoot
    {
        return $this->eventSourceRepository->load($id);
    }

    /**
     * @param AggregateRoot $aggregate
     */
    public function save(AggregateRoot $aggregate): void
    {
        $this->eventSourceRepository->save($aggregate);
    }
}
