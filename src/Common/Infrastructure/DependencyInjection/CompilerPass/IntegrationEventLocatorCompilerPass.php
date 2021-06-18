<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\DependencyInjection\CompilerPass;

use App\Common\Infrastructure\IntegerationEvent\IntegrationEventLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class IntegrationEventLocatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(IntegrationEventLocator::class);

        foreach ($container->findTaggedServiceIds('integration_event') as $id => $attributes) {
            $definition->addMethodCall(
                'add',
                [$id]
            );
        }
    }
}
