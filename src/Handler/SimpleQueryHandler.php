<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Handler;

use XgcBroadwayBundle\Query\Query;

/**
 * Class SimpleQueryHandler
 *
 * @package Xgc\Common\Handler
 */
class SimpleQueryHandler implements QueryHandler
{

    /**
     * @param Query $query
     *
     * @return mixed
     */
    public function handle(Query $query)
    {
        $method = $this->getHandleMethod($query);

        return $this->$method($query);
    }

    /**
     * @param Query $query
     *
     * @return bool
     */
    public function canHandle(Query $query): bool
    {
        $method = $this->getHandleMethod($query);

        return \method_exists($this, $method);
    }

    /**
     * @param Query $query
     *
     * @return string
     */
    private function getHandleMethod(Query $query): string
    {
        $classParts = \explode('\\', \get_class($query));

        return 'handle' . \end($classParts);
    }
}
