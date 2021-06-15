<?php
declare(strict_types=1);

namespace App\Common\Application\Command;

use RuntimeException;

final class CommandValidationException extends RuntimeException
{
    private array $messages;
    private string $commandFQCN;

    public function __construct(array $messages, string $commandFQCN)
    {
        parent::__construct(sprintf(
            '%s: %s',
            $commandFQCN,
            implode("\n", $messages)
        ));

        $this->messages = $messages;
        $this->commandFQCN = $commandFQCN;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function getCommandFQCN(): string
    {
        return $this->commandFQCN;
    }
}
