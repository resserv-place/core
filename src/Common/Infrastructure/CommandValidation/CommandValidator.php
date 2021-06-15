<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\CommandValidation;

interface CommandValidator
{
    public function getValidatorYmlPath(): string;
}
