<?php

namespace App\Post;

use App\Core\AbstractRepository;


class PostsRepository extends AbstractRepository
{

  public function getTableName()
  {
    return "posts";
  }

  public function getModelName()
  {
    return "App\\Post\\PostModel";
  }

  public function update(PostModel $model)
  {
    $table = $this->getTableName();
    $query = "UPDATE `{$table}` SET `title` = :title, `content` = :content WHERE `id` = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
      'title' => $model->title,
      'content' => $model->content,
      'id' => $model->id
    ]);
  }

}

 ?>
