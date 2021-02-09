<?php

namespace App\Model;

/**
 *
 */
class PictureManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'picture';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $picture
     * @return int
     */
    public function insert(array $picture): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " 
            (`url`, `product_id`) VALUES (:url, :product_id)"
        );
        $statement->bindValue('url', $picture['url'], \PDO::PARAM_STR);
        $statement->bindValue('product_id', $picture['product_id'], \PDO::PARAM_INT);
    
        if ($statement->execute()) {
            return (int) $this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $picture
     * @return bool
     */
    public function update(array $picture): bool
    {

        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET 
            (`url`, `product_id`) VALUES (:url, :product_id)
            WHERE id=:id"
        );
        $statement->bindValue('id', $picture['id'], \PDO::PARAM_INT);
        $statement->bindValue('url', $picture['url'], \PDO::PARAM_INT);
        $statement->bindValue('product_id', $picture['product_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
