<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration;

interface RegistrationChecker
{
    public function isUniqueEmail(string $email): bool;
}
