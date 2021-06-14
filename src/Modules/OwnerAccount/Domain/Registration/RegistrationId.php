<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Domain\Registration;

use Ramsey\Uuid\UuidInterface;

class RegistrationId
{
    public function __construct(private UuidInterface $id)
    {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function equals(RegistrationId $other)
    {
        $this->id->equals($other->getId());
    }
}
