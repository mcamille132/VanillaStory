<?php

namespace App\Model;

/**
 *
 */
class CommandManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'command';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $article
     * @return int
     */
    public function insert(array $data): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (firstname, lastname, address, total, created_at) 
        VALUES (:firstname, :lastname, :address, :total, :created_at)");
        $statement->bindValue('firstname', $data['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $data['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('address', $data['address'], \PDO::PARAM_STR);
        $statement->bindValue('total', $data['total'], \PDO::PARAM_INT);
        $statement->bindValue('created_at', $data['date']);
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
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
     * @param array $article
     * @return bool
     */
    public function update(array $article):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET firstname=:firstname, price=:price, picture=:picture WHERE id=:id");
        $statement->bindValue('id', $article['id'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $article['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('price', $article['price'], \PDO::PARAM_INT);
        $statement->bindValue('picture', $article['picture'], \PDO::PARAM_STR);

        return $statement->execute();
    }
  
}
