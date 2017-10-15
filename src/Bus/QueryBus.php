<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Bus;

use XgcBroadwayBundle\Handler\QueryHandler;
use XgcBroadwayBundle\Query\Query;

/**
 * Core QueryBus
 *
 * @package Xgc\Common\Bus
 */
interface QueryBus
{
    /**
     * @param Query $query
     */
    public function dispatch(Query $query);

    /**
     * @param QueryHandler $handler
     */
    public function subscribe(QueryHandler $handler);
}
