<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\IntegerationEvent;

use App\Common\Application\IntegrationEvents\IntegrationEvent;
use Doctrine\DBAL\Connection;
use Symfony\Component\Serializer\SerializerInterface;

class IntegrationEventPersister
{
    public function __construct(
        private Connection $connection,
        private SerializerInterface $serializer
    ) {
    }

    public function persist(IntegrationEvent $event):  void
    {
        $this->connection->insert('system.outbox', [
            'id' => $event->getEventId(),
            'type' => IntegrationEventsDictionary::getEventName(get_class($event)),
            'occurred_on' => $event->getOccurredOn()->format(DATE_ISO8601),
            'data' => $this->serializer->serialize($event, 'json')
        ]);
    }
}
