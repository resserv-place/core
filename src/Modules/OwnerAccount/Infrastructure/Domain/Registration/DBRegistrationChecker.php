<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Infrastructure\Domain\Registration;

use App\Modules\OwnerAccount\Domain\Registration\RegistrationChecker;
use Doctrine\DBAL\Connection;

final class DBRegistrationChecker implements RegistrationChecker
{
    private const TABLE_NAME = 'owner_account.registrations';

    public function __construct(private Connection $connection)
    {
    }

    public function isUniqueEmail(string $email): bool
    {
        // todo: add union to owner table
        $sql = '
            SELECT
                id
            FROM
                owner_account.registrations r
            WHERE
                r.email = ":EMAIL"
        ';

        $statement = $this->connection->prepare($sql);

        $statement->bindValue('EMAIL', $email);

        return $statement->rowCount() === 0;
    }
}
