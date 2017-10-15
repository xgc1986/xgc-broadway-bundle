<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\Exception;

use RuntimeException;

/**
 * Class NoQueryHandlerException
 *
 * @package Xgc\Common\Exception
 */
class NoQueryHandlerException extends RuntimeException
{
    /**
     * NoQueryHandlerException constructor.
     *
     * @param string $class
     */
    public function __construct(string $class)
    {
        parent::__construct("No query handler to handle \"$class\".");
    }
}
