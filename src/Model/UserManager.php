<?php

namespace App\Model;

/**
 *
 */
class UserManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectOneByEmail(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE email=:email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetchObject();
        if ($user) {
            return $user;
        }
        return false;
    }
    
    public function insert(array $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (firstname , lastname, pwd, street, city, email, role_id) 
        VALUES (:firstname, :lastname, :pwd, :street, :city, :email, :role_id)");
        $statement->bindValue('firstname', $user['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('pwd', $user['pwd'], \PDO::PARAM_STR);
        $statement->bindValue('street', $user['street'], \PDO::PARAM_STR);
        $statement->bindValue('city', $user['city'], \PDO::PARAM_STR);
        $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
        $statement->bindValue('role_id', $user['role_id'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function update(array $user): bool
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET
            `firstname` = :firstname,
            `lastname` = :lastname,
            `pwd` = :pwd,
            `street` = :street,
            `city` = :city,
            `email` = :email
            WHERE id=:id"
        );
        $statement->bindValue('id', $user['id'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $user['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('pwd', $user['pwd'], \PDO::PARAM_STR);
        $statement->bindValue('street', $user['street'], \PDO::PARAM_STR);
        $statement->bindValue('city', $user['city'], \PDO::PARAM_STR);
        $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function selectOneWithDetails(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT
        user.id,
        user.firstname,
        user.lastname,
        user.pwd,
        user.street,
        user.city,
        user.email
        FROM $this->table
        WHERE user.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch();

        return $user;
    }

    public function selectAllWithDetails()
    {
        // prepared request
        return $this->pdo->query("SELECT
        user.id,
        user.firstname,
        user.lastname,
        user.city,
        user.email
        FROM $this->table")->fetchAll();
    }
}
