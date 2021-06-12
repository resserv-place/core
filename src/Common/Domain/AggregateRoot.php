<?php
declare(strict_types=1);

namespace App\Common\Domain;

abstract class AggregateRoot
{
    final protected function publishDomainEvent(DomainEvent $domainEvent): void
    {
        DomainEvents::publish($domainEvent);
    }
}
