<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\CommandValidation;

class CommandValidatorLocator
{
    private array $paths = [];

    public function add(CommandValidator $commandValidator): void
    {
        $path = $commandValidator->getValidatorYmlPath();

        if (in_array($path, $this->paths, true)) {
            throw new \InvalidArgumentException(sprintf('Path [%s] already registered', $path));
        }

        $this->paths[] = $commandValidator->getValidatorYmlPath();
    }

    public function getAllPaths(): array
    {
        return $this->paths;
    }
}
