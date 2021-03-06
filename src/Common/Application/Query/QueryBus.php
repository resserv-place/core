<?php
declare(strict_types=1);

namespace App\Common\Application\Query;

interface QueryBus
{
    public function handle(Query $query): mixed;
}
