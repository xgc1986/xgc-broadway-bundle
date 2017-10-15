<?php
declare(strict_types=1);

namespace XgcBroadwayBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use XgcBroadwayBundle\DependencyInjection\QueryHandlerPass;

/**
 * Class XgcBroadwayBundle
 */
class XgcBroadwayBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new QueryHandlerPass());
    }
}
