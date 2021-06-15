<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\DependencyInjection\CompilerPass;

use App\Common\Infrastructure\CommandValidation\CommandValidatorLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class CommandValidatorLocatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(CommandValidatorLocator::class);

        foreach ($container->findTaggedServiceIds('command.validator.configuration') as $id => $attributes) {
            $definition->addMethodCall(
                'add',
                [new Reference($id)]
            );
        }
    }
}
