<?php

namespace App\Model;

/**
 *
 */
class CategoryManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'category';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $category
     * @return int
     */
    public function insert(array $category): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " 
            (`name`, `img`) VALUES (:name, :img)"
        );
        $statement->bindValue('name', $category['name'], \PDO::PARAM_STR);
        $statement->bindValue('img', $category['img'], \PDO::PARAM_STR);
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
     * @param array $category
     * @return bool
     */
    public function update(array $category): bool
    {

        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET 
            `name` = :name,
            `img` = :img
            WHERE id=:id"
        );
        $statement->bindValue('id', $category['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $category['name'], \PDO::PARAM_STR);
        $statement->bindValue('img', $category['img'], \PDO::PARAM_STR);

        return $statement->execute();
    }

}
