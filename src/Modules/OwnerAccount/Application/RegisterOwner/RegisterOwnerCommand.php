<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Application\RegisterOwner;

use App\Common\Application\Command\Command;

final class RegisterOwnerCommand implements Command
{
    public function __construct(
        private string $email,
        private string $password,
        private string $firstName,
        private string $lastName
    ) {
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
}
