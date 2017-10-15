<?php
declare(strict_types=1);

namespace XgcBroadwayBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class QueryHandlerPass
 * @package App\DependencyInjection
 */
class QueryHandlerPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     *
     * @throws ServiceNotFoundException
     * @throws InvalidArgumentException
     */
    public function process(ContainerBuilder $container): void
    {
        $definition = $container->findDefinition('broadway.query_handling.query_bus');

        $taggedServices = $container->findTaggedServiceIds('broadway.query_handler');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('subscribe', [new Reference($id)]);
        }
    }
}
