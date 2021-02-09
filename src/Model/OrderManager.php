<?php

namespace App\Model;

/**
 *
 */
class OrderManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'order';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $order
     * @return int
     */
    public function insert(array $order): int
    {
     
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO `order` (total, created_at, user_id)
        VALUES (:total, :created_at, :user_id)");
        $statement->bindValue('total', $order['total'], \PDO::PARAM_INT);
        $statement->bindValue('created_at', $order['created_at'], \PDO::PARAM_STR);
        $statement->bindValue('user_id', $order['user_id'], \PDO::PARAM_INT);
        if ($statement->execute()) {
            return (int) $this->pdo->lastInsertId();
        }
    }

    public function selectAllWithDetail(): array
    {
        return $this->pdo->query(
            "SELECT 
            `order`.id,
            `order`.total,
            `order`.created_at,
            user.firstname as user_firstname,
            user.lastname as user_lastname,
            `order`.user_id
            FROM `order`
            INNER JOIN user ON `order`.user_id = user.id"
        )
        ->fetchAll();
    }
}
