<?php
declare(strict_types=1);

namespace App\Common\Domain;

abstract class Entity
{
    final protected function publishDomainEvent(DomainEvent $domainEvent): void
    {
        DomainEvents::publish($domainEvent);
    }

    final protected static function checkRule(BusinessRule $rule): void
    {
        if (!$rule->isValid()) {
            throw new BusinessRuleException($rule);
        }
    }
}
