<?php

declare(strict_types=1);

namespace App\Domain\Client\Query\FindOne;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Knp\Component\Pager\PaginatorInterface;


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
    public function one(int $id): ?ClientDetailView
    {
        $qb = $this->connection->createQueryBuilder()
            ->select([
        'id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'consent_personal_data',
        'education_id',
        'operator_id',
        'scoring'
    ])
        ->from('clients')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->executeQuery();

        /**
         * @var array{id: int, first_name: string, last_name: string, phone: string, email: string, consent_personal_data: bool, education_id: int, operator_id: int, scoring: int}|false $row
         */
        $row =  $qb->fetchAssociative();
        if ($row === false) {
            return null;
        }


        return new ClientDetailView(
            id: $row['id'],
            first_name: $row['first_name'],
            last_name: $row['last_name'],
            phone: $row['phone'],
            email: $row['email'],
            consent_personal_data: (bool)$row['consent_personal_data'],
            education_id: $row['education_id'],
            operator_id: $row['operator_id'],
            scoring: $row['scoring']

        );
    }
}