<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Middleware;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Throwable;
use Doctrine\ORM\EntityManagerInterface;

final class DbTransactionMiddleware implements MiddlewareInterface
{
    protected ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->managerRegistry->getManager();

        $entityManager->getConnection()->beginTransaction();

        try {
            $envelope = $stack->next()->handle($envelope, $stack);

            $entityManager->getConnection()->commit();

            return $envelope;
        } catch (Throwable $exception) {
            $entityManager->getConnection()->rollBack();

            throw $exception;
        }
    }
}
