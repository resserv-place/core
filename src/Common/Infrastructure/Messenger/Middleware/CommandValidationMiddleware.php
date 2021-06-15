<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Middleware;

use App\Common\Application\Command\CommandValidationException;
use App\Common\Infrastructure\CommandValidation\CommandValidatorLocator;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class CommandValidationMiddleware implements MiddlewareInterface
{
    public function __construct(private CommandValidatorLocator $commandValidatorLocator)
    {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $command = $envelope->getMessage();

        $validator = Validation::createValidatorBuilder()
            ->addYamlMappings($this->commandValidatorLocator->getAllPaths());

        $errors = $validator->getValidator()->validate($command);

        if ($errors->count() > 0) {
            $errorMessages = [];
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            throw new CommandValidationException($errorMessages, $command::class);
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
