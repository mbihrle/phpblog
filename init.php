<?php

require __DIR__ . "./autoload.php";
//require __DIR__ . "./database.php";

//Absicherung gegen Cross Site Scripting (XSS-Angriffe)
//Muss für jede Ausgabe verwendet werden
function e($str)  //e für escaping
{
  return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
$container = new App\Core\Container();


 ?>
