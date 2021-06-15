<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration;

use App\Common\Domain\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

class OwnerRegistration extends AggregateRoot
{
    public function __construct(
        private RegistrationId $id,
        private string $email,
        private string $password,
        private string $firstName,
        private string $lastName,
        private UuidInterface $confirmationToken
    ) {
    }

    public static function new(
        RegistrationId $id,
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        UuidInterface $confirmationToken,
        RegistrationChecker $registrationChecker
    ): OwnerRegistration {
        if (!$registrationChecker->isUniqueEmail($email)) {
            // todo: throw
        }

        $registration = new self(
            $id,
            $email,
            $password,
            $firstName,
            $lastName,
            $confirmationToken
        );

        $registration->publishDomainEvent(new NewOwnerRegistrationSubmitted(
            $id,
            $email,
            $password,
            $firstName,
            $lastName,
            $confirmationToken->toString()
        ));

        return $registration;
    }

    public function getSnapshot(): OwnerRegistrationSnapshot
    {
        return new OwnerRegistrationSnapshot(
            $this->id->getId()->toString(),
            $this->email,
            $this->password,
            $this->firstName,
            $this->lastName,
            $this->confirmationToken->toString()
        );
    }
}
