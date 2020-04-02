<?php

namespace App\User;

use App\Core\AbstractRepository;
use PDO;



class UsersRepository extends AbstractRepository
{

  public function getTableName()
  {
    return "users";
  }

  public function getModelName()
  {
    return "App\\User\\UserModel";
  }

  public function findByUsername($username)
  {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $query = "SELECT * FROM `$table` WHERE username = :username";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['username' => $username]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
    $user = $stmt->fetch(PDO::FETCH_CLASS);

    return $user;
  }

}

 ?>
