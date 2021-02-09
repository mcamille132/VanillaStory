<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 *
 */

namespace App\Model;

/**
 *
 */
class BlogImageManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'blogImage';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $blogImage
     * @return int
     */
    public function insert(array $blogImage): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`link`, `blogArticle_id`) 
        VALUES 
        (:link, :blogArticle_id)");
        $statement->bindValue('link', $blogImage['link'], \PDO::PARAM_STR);
        $statement->bindValue('blogArticle_id', $blogImage['blogArticle_id'], \PDO::PARAM_INT);

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
     * @param array $blogImage
     * @return bool
     */
    public function update(array $blogImage):bool
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE ." SET 
            `link`=:link, 
            `blogArticle_id`=blogArticle_id
            WHERE id=:id"
        );
        $statement->bindValue('id', $blogImage['id'], \PDO::PARAM_INT);
        $statement->bindValue('link', $blogImage['link'], \PDO::PARAM_STR);
        $statement->bindValue('blogArticle_id', $blogImage['blogArticle_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function selectAll(): array
    {
        return $this->pdo->query("SELECT 
            blogImage.id,
            blogImage.link,
            blogArticle.title as blogArticle_title,
            blogArticle.content as blogArticle_content,
            blogImage.blogArticle_id,   
            FROM blogImage 
            LEFT JOIN blogArticle ON blogImage.blogArticle_id=blogArticle.id")->fetchAll();
    }

    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT 
            blogImage.id,
            blogImage.link,
            blogArticle.title as blogArticle_title,
            blogArticle.content as blogArticle_content,
            blogImage.blogArticle_id,   
            FROM blogImage 
            LEFT JOIN blogArticle ON blogImage.blogArticle_id=blogArticle.id
            WHERE blogImage.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
