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
        'operator',
        'phone',
        'email',
        'consent_personal_data',
        'education'
    ])
        ->from('clients')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->executeQuery();

        /**
         * @var array{id: int, first_name: string, last_name: string, operator: string, phone: string, email: string, consent_personal_data: int, education: string}|false $row
         */
        $row =  $qb->fetchAssociative();
        if ($row === false) {
            return null;
        }

        return new ClientDetailView(
            id: $row['id'],
            first_name: $row['first_name'],
            last_name: $row['last_name'],
            operator: $row['operator'],
            phone: $row['phone'],
            email: $row['email'],
            consent_personal_data: $row['consent_personal_data'],
            education: $row['education'],

        );
    }
}