<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Test;

use Broadway\CommandHandling\CommandHandler;
use Broadway\CommandHandling\SimpleCommandBus;
use Broadway\EventHandling\EventBus;
use Broadway\EventHandling\SimpleEventBus;
use Broadway\ReadModel\Projector;
use XgcBroadwayBundle\Bus\CommandBus;
use XgcBroadwayBundle\Bus\QueryBus;
use XgcBroadwayBundle\Bus\SimpleQueryBus;
use XgcBroadwayBundle\Command\Command;
use XgcBroadwayBundle\Handler\QueryHandler;
use XgcBroadwayBundle\Query\Query;

/**
 * Class TestCase
 *
 * @package Xgc\Common\Tests
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var SimpleEventBus
     */
    private $eventBus;

    protected function setUp()
    {
        $this->queryBus   = new SimpleQueryBus();
        $this->commandBus = new SimpleCommandBus();
        $this->eventBus   = new SimpleEventBus();
    }

    /**
     * @return QueryBus
     */
    public function getQueryBus(): QueryBus
    {
        return $this->queryBus;
    }

    /**
     * @return CommandBus
     */
    public function getCommandBus(): CommandBus
    {
        return $this->commandBus;
    }

    /**
     * @return EventBus
     */
    public function getEventBus(): EventBus
    {
        return $this->eventBus;
    }

    /**
     * @param object $foo
     */
    public function subscribe(/* object */ $foo)
    {
        if ($foo instanceof CommandHandler) {
            $this->commandBus->subscribe($foo);
        } elseif ($foo instanceof QueryHandler) {
            $this->queryBus->subscribe($foo);
        } elseif ($foo instanceof Projector) {
            $this->eventBus->subscribe($foo);
        } else {
            throw new \RuntimeException(\get_class($foo) . ' cannot be subscribed.');
        }
    }

    /**
     * @param object $var
     *
     * @return mixed
     */
    public function dispatch(/* object */ $var)
    {
        $ret = false;
        if ($var instanceof Query) {
            $ret = $this->queryBus->dispatch($var);
        } elseif ($var instanceof Command) {
            $this->commandBus->dispatch($var);
        } else {
            throw new \RuntimeException(\get_class($var) . ' cannot be dispatched.');
        }

        return $ret;
    }
}
