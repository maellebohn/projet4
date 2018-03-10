<?php
// namespace projet4\Modele;

require_once 'Modele/Manager.php';

class AdminManager extends Manager
{
  private $database;

  public function __construct(array $database){
    $this->database = $database;
  }

  //Récupère le mot de passe et l'id correspondant à un username si il existe
  public function connect(string $username) {
    // $bdd = getBdd();
    $connect = $this->getBdd($this->database)->prepare('select password, id from adminUser where username=:username;');
    $connect->execute(array(":username"=>$username));
    $result=$connect->fetch();
    return $result;
  }

  //Mise à jour de la table après modification du mot de passe
  public function modifyPassword(string $newpassword, string $username) {
    // $bdd = getBdd();
    $modifyPassword = $this->getBdd($this->database)->prepare('update adminUser set password=:password where username=:username;');
    $modifyPassword->execute(array(":password"=>$newpassword, ":username"=> $username));
  }
}
