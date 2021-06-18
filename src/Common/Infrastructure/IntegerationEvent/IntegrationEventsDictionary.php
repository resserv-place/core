<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\IntegerationEvent;

use App\Modules\OwnerAccount\Application\IntegrationEvents\NewOwnerRegistrationSubmittedIntegrationEvent;
use InvalidArgumentException;

class IntegrationEventsDictionary
{
    private const EVENT_NAMES = [
        NewOwnerRegistrationSubmittedIntegrationEvent::class => 'owner_account.owner_registration_submitted'
    ];

    public static function getEventName(string $className): string
    {
        $eventName = self::EVENT_NAMES[$className] ?? null;

        if ($eventName === null) {
            throw new InvalidArgumentException(sprintf(
                'Event name for event class [%s] not found',
                $className
            ));
        }

        return $eventName;
    }

    public static function getEventClassName(string $eventName): string
    {
        $eventClassName = array_flip(self::EVENT_NAMES)[$eventName] ?? null;

        if ($eventClassName === null) {
            throw new InvalidArgumentException(sprintf(
                'Event className for event name [%s] not found',
                $eventName
            ));
        }

        return $eventClassName;
    }
}
