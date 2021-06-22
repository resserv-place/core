<?php
declare(strict_types=1);

namespace App\Common\Domain;

final class DomainEvents
{
    /**
     * @var DomainEvent[]
     */
    private static array $events = [];

    public static function publish(DomainEvent $domainEvent): void
    {
        self::$events[] = $domainEvent;
    }

    /**
     * @return DomainEvent[]
     */
    public static function getEvents(): array
    {
        return self::$events;
    }

    public static function clearEvents(): void
    {
        self::$events = [];
    }
}
