<?php

namespace App\Model;

class BlogArticleManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'blogArticle';
    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    /**
     * @param array $blogArticle
     * @return int
     */
    public function insert(array $blogArticle): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . "
            (`title`,`content`)
            VALUES
            (:title, :content)"
        );
        $statement->bindValue('title', $blogArticle['title'], \PDO::PARAM_STR);
        $statement->bindValue('content', $blogArticle['content'], \PDO::PARAM_STR);
        
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
     * @param array $blogArticle
     * @return bool
     */
    public function update(array $blogArticle): bool
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET
            `title` = :title,
            `content` = :content
            WHERE id=:id"
        );
        $statement->bindValue('id', $blogArticle['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $blogArticle['title'], \PDO::PARAM_STR);
        $statement->bindValue('content', $blogArticle['content'], \PDO::PARAM_INT);
        return $statement->execute();
    }
    
    public function selectAllWithImg(): array
    {
            $blogArticles = $this->pdo->query("SELECT 
            blogArticle.id,
            blogArticle.title,
            blogArticle.content
            FROM blogArticle")->fetchAll();
            
            return $this->getArticleImages($blogArticles);
    }


    public function selectOneWithImg(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT
        blogArticle.id,
        blogArticle.title,
        blogArticle.content
        FROM blogArticled
        WHERE blogArticle.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $blogArticle = $statement->fetch();

        $statementImg = $this->pdo->prepare('SELECT link FROM blogImage WHERE blogArticle_id=:blogArticle_id');
        $statementImg->bindValue('blogArticle_id', $id, \PDO::PARAM_INT);
        $statementImg->execute();
        $blogImages = $statementImg->fetchAll();
        $blogArticle['blogImages'] = $blogImages;
        return $blogArticle;
    }

    // PRIVATE METHOD

    private function getArticleImages(array $blogArticles)
    {
        $result = [];
        foreach ($blogArticles as $blogArticle) {
            $statementImg = $this->pdo->prepare('SELECT 
            link FROM blogImage WHERE blogArticle_id=:blogArticle_id');
            $statementImg->bindValue('blogArticle_id', $blogArticle['id'], \PDO::PARAM_INT);
            $statementImg->execute();
            $blogImages = $statementImg->fetchAll();
            $blogArticle['blogImages'] = $blogImages;
            array_push($result, $blogArticle);
        }
        return $result;
    }
}
