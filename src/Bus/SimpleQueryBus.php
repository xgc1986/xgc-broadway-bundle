<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Bus;

use Exception;
use XgcBroadwayBundle\Exception\NoQueryHandlerException;
use XgcBroadwayBundle\Handler\QueryHandler;
use XgcBroadwayBundle\Query\Query;

/**
 * Class SimpleQueryBus
 *
 * @package Xgc\Common\Bus
 */
class SimpleQueryBus implements QueryBus
{
    /**
     * @var QueryHandler[]
     */
    private $queryHandlers = [];

    /**
     * @param QueryHandler $handler
     */
    public function subscribe(QueryHandler $handler): void
    {
        $this->queryHandlers[] = $handler;
    }

    /**
     * @param $query
     *
     * @return mixed|null

     * @throws Exception
     */
    public function dispatch(Query $query)
    {
        try {
            /** @var QueryHandler $handler */
            foreach ($this->queryHandlers as $handler) {
                if ($handler->canHandle($query)) {
                    return $handler->handle($query);
                }
            }
            throw new NoQueryHandlerException(\get_class($query));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
