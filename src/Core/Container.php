<?php

namespace App\Core;

use PDO;
use Exception;
use PDOException;

use App\User\LoginController;
use App\User\LoginService;
use App\User\UsersRepository;
use App\Post\PostsAdminController;
use App\Post\PostsController;
use App\Post\CommentsRepository;
use App\Post\PostsRepository;



class Container
{

  private $receipts = [];
  private $intances = [];

  public function __construct()
  {
    $this->receipts = [
      'postsAdminController' => function()
      {
        return new PostsAdminController(
          $this->make('postsRepository'),
          $this->make('loginService')
        );
      },
      'loginService' => function()
      {
        return new LoginService(
            $this->make('usersRepository')
        );
      },
      'loginController' => function()
      {
        return new LoginController(
            $this->make('loginService')
        );
      },
      'postsController' => function()
      {
        return new PostsController(
          $this->make('postsRepository'),
          $this->make('commentsRepository')
        );
      },
      'commentsRepository' => function()
      {
        return new CommentsRepository($this->make("pdo"));
      },
      'postsRepository' => function()
      {
        return new PostsRepository($this->make("pdo"));
      },
      'usersRepository' => function()
      {
        return new UsersRepository($this->make("pdo"));
      },
      'pdo' => function()
      {
        try {
          $pdo = new PDO(
            'mysql:host=localhost;
            dbname=blog;
            charset=utf8',  //Sicherheitsaspekt
            'blog',
            'QdMSFSw6Xb3uXL21'
          );
        } catch (PDOException $e) {
          echo "Verbindung zur Datenbank fehlgeschlagen!";
          die();
        }

        // Initialisierung über setAttribute: Sicherheitsaspekt
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
      }
    ];
  }

  public function make($name)
  {
    if (!empty($this->instances[$name]))
    {
      return $this->instances[$name];
    }

    if (isset($this->receipts[$name]))
    {
      $this->instances[$name] =  $this->receipts[$name]();
    }

    //ERZEUGE: $this->instances[$name]
    return $this->instances[$name];
  }


}


 ?>
