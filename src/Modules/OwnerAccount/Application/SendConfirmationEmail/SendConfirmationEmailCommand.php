<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Application\SendConfirmationEmail;

use App\Common\Application\Command\Command;

final class SendConfirmationEmailCommand implements Command
{
    public function __construct(
        private string $email,
        private string $confirmationToken,
        private string $firstName,
        private string $lastName
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
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
