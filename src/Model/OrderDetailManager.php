<?php
namespace App\Model;

/**
 *
 */
class OrderDetailManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'orderDetail';
    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $orderDetail
     * @return int
     */
    public function insert(array $orderDetail): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . "
            (`quantity`,`total`,`order_id`,`product_id`, `user_id`, `status`)
            VALUES
            (:quantity, :total, :order_id, :product_id, :user_id, :status)"
        );
        $statement->bindValue('quantity', $orderDetail['quantity'], \PDO::PARAM_STR);
        $statement->bindValue('total', $orderDetail['total'], \PDO::PARAM_INT);
        $statement->bindValue('order_id', $orderDetail['order_id'], \PDO::PARAM_INT);
        $statement->bindValue('product_id', $orderDetail['product_id'], \PDO::PARAM_INT);
        $statement->bindValue('user_id', $orderDetail['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('status', $orderDetail['status'], \PDO::PARAM_BOOL);
        if ($statement->execute()) {
            return (int) $this->pdo->lastInsertId();
        }
    }

    /**
     * @param array $orderDetail
     * @return bool
     */
    public function update(array $orderDetail): bool
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET
            status = :status
            WHERE id=:id"
        );
        $statement->bindValue('id', $orderDetail['id'], \PDO::PARAM_INT);
        $statement->bindValue('status', $orderDetail['status'], \PDO::PARAM_BOOL);
        
        
        return $statement->execute();
    }


    public function selectOneWithDetails(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT
        orderDetail.id,
        orderDetail.quantity,
        orderDetail.total,
        orderDetail.status,
        `order`.created_at as order_created_at,
        orderDetail.order_id,
        product.name as product_name,
        orderDetail.product_id,
        user.firstname as user_firstname,
        user.lastname as user_lastname,
        user.street as user_street,
        user.city as user_city
        FROM orderDetail
        INNER JOIN `order` ON orderDetail.order_id=`order`.id
        INNER JOIN product ON orderDetail.product_id=product.id
        INNER JOIN user ON orderDetail.user_id=user.id
        WHERE orderDetail.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch();
    }
}
