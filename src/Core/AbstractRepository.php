<?php

namespace App\Core;

use PDO;

abstract class AbstractRepository
{

  protected $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  abstract public function getTableName();
  abstract public function getModelName();

  function all()
  {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $query = "SELECT * FROM `$table`";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    //Bei Abfragen ohne Parameter, können oben stehende beide Zeilen ersetzt werden durch:
    //$stmt =  $this->pdo->query($query);
    $posts = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
    return $posts;
  }


  function find($id)
  {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $query = "SELECT * FROM `$table` WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
    $post = $stmt->fetch(PDO::FETCH_CLASS);

    return $post;
  }


}


?>
