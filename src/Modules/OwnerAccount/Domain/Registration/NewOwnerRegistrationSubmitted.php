<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration;

use App\Common\Domain\DomainEvent;
use Ramsey\Uuid\UuidInterface;

final class NewOwnerRegistrationSubmitted implements DomainEvent
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

    public function getId(): RegistrationId
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getConfirmationToken(): UuidInterface
    {
        return $this->confirmationToken;
    }
}
