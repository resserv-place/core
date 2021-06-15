<?php
declare(strict_types=1);

namespace App\Common\Domain;

use RuntimeException;

final class BusinessRuleException extends RuntimeException
{
    public function __construct(BusinessRule $businessRule)
    {
        parent::__construct($businessRule->getMessage(), $businessRule->getErrorCode());
    }
}
