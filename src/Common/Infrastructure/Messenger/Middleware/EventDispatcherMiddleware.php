<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Middleware;

use App\Common\Application\Event\EventBus;
use App\Common\Domain\DomainEvents;
use App\Common\Infrastructure\IntegerationEvent\IntegrationEventLocator;
use App\Common\Infrastructure\IntegerationEvent\IntegrationEventPersister;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class EventDispatcherMiddleware implements MiddlewareInterface
{
    public function __construct(
        private EventBus $eventBus,
        private IntegrationEventLocator $integrationEventLocator,
        private IntegrationEventPersister $integrationEventPersister
    ) {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $envelope = $stack->next()->handle($envelope, $stack);

        $domainEvents = DomainEvents::getEvents();
        DomainEvents::clearEvents();

        foreach ($domainEvents as $domainEvent) {
            $this->eventBus->dispatch($domainEvent);
        }

        foreach ($domainEvents as $domainEvent) {
            $integrationEventsClassNames = $this->integrationEventLocator->getByDomainEventClassName(get_class($domainEvent));

            foreach ($integrationEventsClassNames as $integrationEventClassName) {
                $integrationEvent = $integrationEventClassName::build($domainEvent);

                $this->integrationEventPersister->persist($integrationEvent);
            }
        }

        return $envelope;
    }
}
