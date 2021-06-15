<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration\Rules;

use App\Common\Domain\BusinessRule;
use App\Modules\OwnerAccount\Domain\Registration\RegistrationChecker;

final class OwnerEmailMustBeUnique implements BusinessRule
{
    public function __construct(private RegistrationChecker $registrationChecker, private string $email)
    {
    }

    public function isValid(): bool
    {
        return !$this->registrationChecker->isUniqueEmail($this->email);
    }

    public function getMessage(): string
    {
        return '';
    }

    public function getErrorCode(): int
    {
        return 1;
    }
}
