<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Infrastructure\Configuration\Validation;

use App\Common\Infrastructure\CommandValidation\CommandValidator as CommandValidatorInterface;

final class CommandValidator implements CommandValidatorInterface
{
    public function getValidatorYmlPath(): string
    {
        return 'src/Modules/OwnerAccount/Infrastructure/Configuration/Resources/validation.yml';
    }
}
