<?php

namespace App\Model;

/**
 *
 */
class FaqManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'faq';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $faq
     * @return int
     */
    public function insert(array $faq): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " 
            (`question`, `answer`) VALUES (:question, :answer)"
        );
        $statement->bindValue('question', $faq['question'], \PDO::PARAM_STR);
        $statement->bindValue('answer', $faq['answer'], \PDO::PARAM_STR);
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
     * @param array $faq
     * @return bool
     */
    public function update(array $faq): bool
    {

        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET 
            `question` = :question,
            `answer` = :answer
            WHERE id=:id"
        );
        $statement->bindValue('id', $faq['id'], \PDO::PARAM_INT);
        $statement->bindValue('question', $faq['question'], \PDO::PARAM_STR);
        $statement->bindValue('answer', $faq['answer'], \PDO::PARAM_STR);

        return $statement->execute();
    }

}
