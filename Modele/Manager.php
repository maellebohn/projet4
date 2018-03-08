<?php
// namespace projet4\Modele;

class Manager
{
  protected function getBdd()
  {
    $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'jean','Louise@13', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
  }
}
