<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\IntegerationEvent;

use App\Common\Application\IntegrationEvents\IntegrationEvent;

class IntegrationEventLocator
{
    private array $events = [];

    /**
     * @param IntegrationEvent|string $integrationEventClassName
     */
    public function add(string $integrationEventClassName): void
    {
        if (isset($this->events[$integrationEventClassName::basedOn()])) {
            $this->events[$integrationEventClassName::basedOn()][] = $integrationEventClassName;
        } else {
            $this->events[$integrationEventClassName::basedOn()] = [$integrationEventClassName];
        }
    }

    /**
     * @return IntegrationEvent[]|string[]
     */
    public function getByDomainEventClassName(string $domainEventClassName): array
    {
        return $this->events[$domainEventClassName] ?? [];
    }
}
