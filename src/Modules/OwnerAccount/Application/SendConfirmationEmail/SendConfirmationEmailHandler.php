<?php
declare(strict_types=1);

namespace App\Modules\OwnerAccount\Application\SendConfirmationEmail;

use App\Common\Application\Command\CommandHandler;

class SendConfirmationEmailHandler implements CommandHandler
{
    public function __invoke(SendConfirmationEmailCommand $command): void
    {
        // send email
    }
}
