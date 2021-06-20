<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\IntegrationEvent\Outbox\Cli;

use App\Common\Application\Command\CommandBus;
use App\Common\Infrastructure\IntegrationEvent\Outbox\HandleOutboxMessagesCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class OutboxProcess extends Command
{
    protected static $defaultName = 'outbox:process';

    public function __construct(private CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while (true) {
            $this->commandBus->dispatch(new HandleOutboxMessagesCommand());

            sleep(2);
        }
    }
}

