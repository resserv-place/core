<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger;

use App\Common\Application\Event\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch(object $event): void
    {
        $this->eventBus->dispatch($event);
    }
}
