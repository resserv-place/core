<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\IntegrationEvent\Outbox;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Event\EventBus;
use App\Common\Application\IntegrationEvents\IntegrationEvent;
use App\Common\Infrastructure\IntegrationEvent\IntegrationEventsDictionary;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Symfony\Component\Serializer\SerializerInterface;

final class HandleOutboxMessagesHandler implements CommandHandler
{
    public function __construct(
        private EventBus $eventBus,
        private Connection $connection,
        private SerializerInterface $serializer
    ) {
    }

    public function __invoke(HandleOutboxMessagesCommand $command): void
    {
        $messages = $this->getMessages();

        if (empty($messages)) {
            return;
        }

        foreach ($messages as $message) {
            /** @var IntegrationEvent $integrationEvent */
            $integrationEvent = $this->serializer->deserialize(
                $message['data'],
                IntegrationEventsDictionary::getEventClassName($message['type']),
                'json'
            );
            
            $this->eventBus->dispatch($integrationEvent);
            
            $this->markAsSent($integrationEvent->getEventId());
        }
    }

    private function getMessages(): array
    {
        $result = $this->connection->executeQuery('
            SELECT
                *
            FROM
                system.outbox o
            WHERE 
                o.sent_at IS NULL
            ORDER BY
                o.occurred_on
            FOR UPDATE 
        ');

        return $result->fetchAllAssociative();
    }

    private function markAsSent(string $id): void
    {
        $this->connection->update('system.outbox', [
            'sent_at' => (new DateTimeImmutable())->format(DATE_ISO8601)
        ], [
            'id' => $id
        ]);
    }
}
