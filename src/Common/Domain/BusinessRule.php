<?php
declare(strict_types=1);

namespace App\Common\Domain;

interface BusinessRule
{
    public function isValid(): bool;
    public function getMessage(): string;
    public function getErrorCode(): int;
}
