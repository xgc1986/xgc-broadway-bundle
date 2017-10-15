<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Handler;

use XgcBroadwayBundle\Query\Query;

/**
 * Interface QueryHandler
 *
 * @package Xgc\Common\Handler
 */
interface QueryHandler
{
    /**
     * @param Query $query
     */
    public function handle(Query $query);

    /**
     * @param Query $query
     *
     * @return bool
     */
    public function canHandle(Query $query): bool;
}
