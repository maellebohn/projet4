<?php
// namespace projet4\Controleur;

require_once 'Modele/LoginManager.php';
require_once 'Controleur/controleurAdmin.php';
require_once 'Vue/Vue.php';

class ControleurUser {
  private $username;
  private $password;
  private $new_password;
  private $message = false;
  private $manager;
  private $ctrlAdmin;

  public function __construct(array $database) {
    $this->manager=new AdminManager($database);
    $this-> ctrlAdmin=new ControleurAdmin($database);
  }

  public function connexion(string $username = null,string $password = null) {
    if (empty($username) && empty($password)) {
      $vue=new Vue("Login");
      $vue->generer(array());
    } else {
      $this->username = htmlspecialchars($username);
      $this->password = htmlspecialchars($password);

      $result=$this->manager->connect($this->username);
      $isValid = $this->verification($result[0]);
      $this->setSession($isValid,$result);
    }
  }

  private function verification(string $passwordresult) {
    return password_verify($this->password, $passwordresult);
  }

  private function setSession(bool $isValid, $result) {
    if ($isValid) {
      $_SESSION['username'] = $this->username;
      $_SESSION['id'] = $result[1];
      $this->ctrlAdmin->administration();

    } else {
      // Autrement => message d'erreur
      $this->message=true;
      $vue=new Vue("Login");
      $vue->generer(array("message"=>$this->message));
    }
  }

  public function modifyUser(string $username = null,string $password = null, string $new_password=null) {
    if (empty($username) && empty($password) && empty($new_password)) {
      $vue=new Vue("Password");
      $vue->generer(array());
    } else {
      $this->username = htmlspecialchars($username);
      $this->password = htmlspecialchars($password);
      $this->new_password = htmlspecialchars($new_password);

      $result=$this->manager->connect($this->username);
      $isValid = $this->verification($result[0]);

      if ($isValid) {
        $newpassword = password_hash("$this->new_password", PASSWORD_DEFAULT);
        $this->manager->modifyPassword($newpassword, $this->username);
        $this->ctrlAdmin->administration();
      } else {
        // Autrement => message d'erreur
        $this->message=true;
        $vue=new Vue("Password");
        $vue->generer(array("message"=>$this->message));;
      }
    }
  }

  function deconnexion() {
    $_SESSION = array();
    session_destroy();
    unset($_SESSION);
    $this->connexion();
  }
}
