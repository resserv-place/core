<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Application\RegisterOwner;

use App\Common\Application\Command\CommandHandler;
use App\Modules\OwnerAccount\Application\PasswordManager;
use App\Modules\OwnerAccount\Domain\Registration\OwnerRegistration;
use App\Modules\OwnerAccount\Domain\Registration\OwnerRegistrationRepository;
use Ramsey\Uuid\Uuid;

final class RegisterOwnerHandler implements CommandHandler
{
    public function __construct(
        private OwnerRegistrationRepository $ownerRegistrationRepository,
        private PasswordManager $passwordManager
    ) {
    }

    public function __invoke(RegisterOwnerCommand $command): void
    {
        $registration = OwnerRegistration::new(
            $this->ownerRegistrationRepository->nextIdentity(),
            $command->getEmail(),
            $this->passwordManager->hash($command->getPassword()),
            $command->getFirstName(),
            $command->getLastName(),
            Uuid::uuid4()
        );

        $this->ownerRegistrationRepository->add($registration);
    }
}
