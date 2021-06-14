<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Middleware;

use App\Common\Application\Event\EventBus;
use App\Common\Domain\DomainEvents;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class DomainEventDispatcherMiddleware implements MiddlewareInterface
{
    public function __construct(private EventBus $eventBus)
    {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $envelope = $stack->next()->handle($envelope, $stack);

        $domainEvents = DomainEvents::getEvents();
        DomainEvents::clearEvents();

        foreach ($domainEvents as $event) {
            $this->eventBus->dispatch($event);
        }

        DomainEvents::clearEvents();

        return $envelope;
    }
}
