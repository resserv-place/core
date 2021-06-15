<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration;

interface OwnerRegistrationRepository
{
    public function add(OwnerRegistration $registration): void;
    public function nextIdentity(): RegistrationId;
}
