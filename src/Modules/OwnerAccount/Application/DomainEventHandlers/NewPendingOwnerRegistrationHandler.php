<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Application\DomainEventHandlers;

use App\Common\Application\Command\CommandBus;
use App\Common\Application\Event\EventHandler;
use App\Modules\OwnerAccount\Application\SendConfirmationEmail\SendConfirmationEmailCommand;
use App\Modules\OwnerAccount\Domain\Registration\NewOwnerRegistrationSubmitted;

final class NewPendingOwnerRegistrationHandler implements EventHandler
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(NewOwnerRegistrationSubmitted $event): void
    {
        $this->commandBus->dispatch(new SendConfirmationEmailCommand(
            $event->getEmail(),
            $event->getConfirmationToken(),
            $event->getFirstName(),
            $event->getLastName()
        ));
    }
}
