<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Test\Stub;

use XgcBroadwayBundle\Repository\EventSourcingRepository;

/**
 * Class EventSourcingRepositoryStub
 *
 * @package Xgc\Common\Tests\Stub
 */
class EventSourcingRepositoryStub extends EventSourcingRepository
{
    /**
     * @return string
     */
    protected function aggregateClass(): string
    {
        return 'Stub';
    }
}
