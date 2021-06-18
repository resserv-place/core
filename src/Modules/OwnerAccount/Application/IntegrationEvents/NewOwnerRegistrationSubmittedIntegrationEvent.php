<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Application\IntegrationEvents;

use App\Common\Application\IntegrationEvents\IntegrationEvent;
use App\Common\Domain\DomainEvent;
use App\Modules\OwnerAccount\Domain\Registration\NewOwnerRegistrationSubmitted;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

final class NewOwnerRegistrationSubmittedIntegrationEvent implements IntegrationEvent
{
    public function __construct(
        private string $eventId,
        private DateTimeImmutable $occurredOn,
        private string $registrationId,
        private string $email,
        private string $firstName,
        private string $lastName,
        private string $confirmationToken
    ) {
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function getRegistrationId(): string
    {
        return $this->registrationId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }

    public static function basedOn(): string
    {
        return NewOwnerRegistrationSubmitted::class;
    }

    /**
     * @param NewOwnerRegistrationSubmitted $event
     */
    public static function build(DomainEvent $event): self
    {
        return new self(
            Uuid::uuid4()->toString(),
            new DateTimeImmutable(),
            $event->getId()->getId()->toString(),
            $event->getEmail(),
            $event->getFirstName(),
            $event->getLastName(),
            $event->getConfirmationToken()
        );
    }
}
