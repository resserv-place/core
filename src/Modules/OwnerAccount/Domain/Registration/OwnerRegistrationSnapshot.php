<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration;

class OwnerRegistrationSnapshot
{
    public function __construct(
        private string $id,
        private string $email,
        private string $password,
        private string $firstName,
        private string $lastName,
        private string $confirmationToken
    ) {
    }

    public function getId(): string
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

    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }
}
