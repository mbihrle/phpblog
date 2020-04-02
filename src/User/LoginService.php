<?php

namespace App\User;

class LoginService
{
    public function __construct(UsersRepository $usersRepository)
    {
      $this->usersRepository = $usersRepository;
    }

    public function attempt($username, $password)
    {
      $user = $this->usersRepository->findByUsername($username);
      if (empty($user)){
        return false;
      }

      if (password_verify($password, $user->password)){
        $_SESSION['login'] = $user->username;
        session_regenerate_id(true);
        return true;
      } else {
        return false;
      }
    }

    public function logout()
    {
      unset($_SESSION['login']);
      session_regenerate_id(true);
    }

    public function check()
    {
      if (isset($_SESSION['login'])) {
        return true;
      } else {
        header("Location: login");
        die();
      }
    }
}

 ?>
