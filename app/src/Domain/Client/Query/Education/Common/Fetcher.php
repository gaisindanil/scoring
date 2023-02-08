<?php

declare(strict_types=1);

namespace App\Domain\Client\Query\Education\Common;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class Fetcher
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @throws Exception
     */
    public function column(Query $query): array
    {
        $qb = $this->connection->createQueryBuilder()
            ->select([
                'id',
                'name',
            ])
            ->from('educations')
            ->orderBy('id', 'DESC');

        $qb->executeQuery();

        return $qb->fetchAllKeyValue();
    }
}
