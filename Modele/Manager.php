<?php
// namespace projet4\Modele;

class Manager
{  
  protected function getBdd($database)
  {
    // return $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'jean','Louise@13', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd = new PDO('mysql:host='.$database["host"].';dbname='.$database["dbname"].';charset=utf8', $database["login"],$database["mdp"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
}
