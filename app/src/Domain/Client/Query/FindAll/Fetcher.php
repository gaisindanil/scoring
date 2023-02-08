<?php

declare(strict_types=1);

namespace App\Domain\Client\Query\FindAll;

use Doctrine\DBAL\Connection;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


class Fetcher
{

    private Connection $connection;
    private PaginatorInterface $paginator;

    public function __construct(Connection $connection, PaginatorInterface $paginator)
    {
        $this->connection = $connection;
        $this->paginator = $paginator;
    }

    public function all(Query $query, int $page, int $size): PaginationInterface
    {
        $result = $this->connection->createQueryBuilder()
            ->select([
                'id',
                'first_name',
                'last_name',
                'phone',
                'email',
                'consent_personal_data',
                'scoring'
            ])
            ->from('clients');

        return $this->paginator->paginate($result, $page, $size);
    }
}