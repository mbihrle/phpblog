<?php

namespace App\Post;

use PDO;
use App\Core\AbstractRepository;


class CommentsRepository extends AbstractRepository
{

  public function getTableName()
  {
    return "comments";
  }

  public function getModelName()
  {
    return "App\\Post\\CommentModel";
  }

  public function insertForPost($postId, $content)
  {
    $table = $this->getTableName();
    $query = "INSERT INTO `$table` (`post_id`, `content`) VALUES (:postId, :content);";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
      'postId' => $postId,
      'content' => $content

    ]);

  }

  public function allByPost($id)
  {
    $table = $this->getTableName();
    $model = $this->getModelname();

    $query = "SELECT * from `$table` WHERE `post_id` = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $comments= $stmt->fetchAll(PDO::FETCH_CLASS, $model);

    return $comments;
  }
}

 ?>
