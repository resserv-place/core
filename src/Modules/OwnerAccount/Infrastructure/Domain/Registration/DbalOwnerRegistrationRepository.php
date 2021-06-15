<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Infrastructure\Domain\Registration;

use App\Modules\OwnerAccount\Domain\Registration\OwnerRegistration;
use App\Modules\OwnerAccount\Domain\Registration\OwnerRegistrationRepository;
use App\Modules\OwnerAccount\Domain\Registration\RegistrationId;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class DbalOwnerRegistrationRepository implements OwnerRegistrationRepository
{
    public function __construct(private Connection $connection)
    {
    }

    public function add(OwnerRegistration $registration): void
    {
        $snapshot = $registration->getSnapshot();

        $this->connection->insert('owner_account.registrations', [
            'id' => $snapshot->getId(),
            'email' => $snapshot->getEmail(),
            'password' => $snapshot->getPassword(),
            'first_name' => $snapshot->getFirstName(),
            'last_name' => $snapshot->getLastName(),
            'confirmation_token' => $snapshot->getConfirmationToken(),
        ]);
    }

    public function nextIdentity(): RegistrationId
    {
        return new RegistrationId(Uuid::uuid4());
    }
}
