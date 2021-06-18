<?php
declare(strict_types=1);

namespace App\Common\Application\IntegrationEvents;

use App\Common\Domain\DomainEvent;
use DateTimeImmutable;

interface IntegrationEvent
{
    public function getEventId(): string;
    public function getOccurredOn(): DateTimeImmutable;
    public static function basedOn(): string;
    public static function build(DomainEvent $event): IntegrationEvent;
}
