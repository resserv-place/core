<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\IntegrationEvent;

use App\Common\Application\IntegrationEvents\IntegrationEvent;

class IntegrationEventLocator
{
    /**
     * @var array<string, array<IntegrationEvent|string>>
     */
    private array $events = [];

    /**
     * @param string $integrationEventClassName
     */
    public function add(string $integrationEventClassName): void
    {
        /** @var IntegrationEvent $integrationEventClassName */
        if (isset($this->events[$integrationEventClassName::basedOn()])) {
            $this->events[$integrationEventClassName::basedOn()][] = $integrationEventClassName;
        } else {
            $this->events[$integrationEventClassName::basedOn()] = [$integrationEventClassName];
        }
    }

    /**
     * @return array<string|IntegrationEvent>
     */
    public function getByDomainEventClassName(string $domainEventClassName): array
    {
        return $this->events[$domainEventClassName] ?? [];
    }
}
