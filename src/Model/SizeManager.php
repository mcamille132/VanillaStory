<?php

namespace App\Model;

/**
 *
 */
class SizeManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'size';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $size
     * @return int
     */
    public function insert(array $size): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " 
            (`number`) VALUES (:number)"
        );
        $statement->bindValue('number', $size['number'], \PDO::PARAM_INT);
    
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
     * @param array $size
     * @return bool
     */
    public function update(array $size): bool
    {

        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET 
            `number` = :number WHERE id=:id"
        );
        $statement->bindValue('id', $size['id'], \PDO::PARAM_INT);
        $statement->bindValue('number', $size['number'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}