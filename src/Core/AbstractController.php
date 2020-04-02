<?php

namespace App\Core;

abstract class AbstractController {


  protected function render($view, $params)
  {
    //foreach ($params AS $key => $value) {
    //  ${$key} = $value;
    //}
    //Kürzer ist extract - Funktion
    extract($params);
    include __DIR__ . "/../../views/{$view}.php";
  }
}

 ?>
