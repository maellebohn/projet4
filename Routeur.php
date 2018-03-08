<?php
// namespace projet4;

session_start();

require_once 'Controleur/controleurAccueil.php';
require_once 'Controleur/controleurPost.php';
require_once 'Controleur/controleurUser.php';
require_once 'Controleur/controleurAdmin.php';
require_once 'Controleur/controleurRedaction.php';
require_once 'Vue/Vue.php';

class Routeur {
  private $ctrlAccueil;
  private $ctrlPost;
  private $ctrlUser;
  private $ctrlAdmin;
  private $ctrlRedaction;

  public function __construct() {
    $this->ctrlAccueil = new controleurAccueil();
    $this->ctrlPost = new controleurPost();
    $this->ctrlAdmin = new controleurAdmin();
    $this->ctrlUser = new controleurUser();
    $this->ctrlRedaction = new controleurRedaction();
  }

  // Route une requête entrante : exécution l'action associée
  public function routerRequete() {
    try {
      if (isset($_GET['action'])) {
        if ($_GET['action'] == 'post') {
          $idPost = intval($this->getParametre($_GET, 'id'));
            if ($idPost != 0) {
              $this->ctrlPost->post($idPost);
            }
            else
              throw new Exception("Identifiant de post non valide");
            }
        elseif ($_GET['action'] == 'commenter') {
          $author = htmlspecialchars($this->getParametre($_POST, 'auteur'));
          $content = htmlspecialchars($this->getParametre($_POST, 'contenu'));
          $email = htmlspecialchars($this->getParametre($_POST, 'email'));
          $idPost = $this->getParametre($_POST, 'id');
          $this->ctrlPost->commenter($author, $content, $email, $idPost);
        }
        elseif ($_GET['action'] == 'signaler') {
          $idComment= intval($this->getParametre($_GET,'id'));
          $this->ctrlPost->signalement($idComment);
        }
        elseif ($_GET['action'] == 'login') {
          if(!empty($_POST["username"]) && !empty($_POST["password"])){
            $username=$this->getParametre($_POST,'username');
            $password=$this->getParametre($_POST,'password');
            $this->ctrlUser->connexion($username, $password);
          }else{
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'connect') {
          if (!empty($_SESSION['username'])){
            $this->ctrlAdmin->administration();
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'modifyUser') {
          if (!empty($_SESSION['username'])){
            if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["new-password"])){
              $username=$this->getParametre($_POST,'username');
              $password=$this->getParametre($_POST,'password');
              $new_password=$this->getParametre($_POST,'new-password');
              $this->ctrlUser->modifyUser($username, $password, $new_password);
            }
            else {
              $this->ctrlUser->modifyUser();
            }
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'redaction') {
          if (!empty($_SESSION['username'])){
            $this->ctrlRedaction->redaction();
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'deconnect') {
          $this->ctrlUser->deconnexion();
        }
        elseif ($_GET['action'] == 'creer') {
          if (!empty($_SESSION['username'])){
            if (empty($_POST['id'])){
              $title=htmlspecialchars($this->getParametre($_POST,'title'));
              $content=htmlspecialchars(nl2br($this->getParametre($_POST,'content')));
              $this->ctrlRedaction->poster($title, $content, $_SESSION["id"]);
            }
            else {
              $title=htmlspecialchars($this->getParametre($_POST,'title'));
              $content=htmlspecialchars(nl2br($this->getParametre($_POST,'content')));
              $idPost=$this->getParametre($_POST,'id');
              $this->ctrlRedaction->modifier($title,$content,$idPost);
            }
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'supprimer') {
          if (!empty($_SESSION['username'])){
            $idPost = intval($this->getParametre($_GET,'id'));
            $this->ctrlAdmin->supprimer($idPost);
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'delete') {
          if (!empty($_SESSION['username'])){
            $idComment = intval($this->getParametre($_GET,'id'));
            $this->ctrlAdmin->supprimerComment($idComment);
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        elseif ($_GET['action'] == 'modifier') {
          if (!empty($_SESSION['username'])){
            $idPost = intval($this->getParametre($_GET,'id'));
            $this->ctrlRedaction->recup($idPost);
          }
          else {
            $this->ctrlUser->connexion();
          }
        }
        else
          throw new Exception("Action non valide");
    }
    else {  // aucune action définie : affichage de l'accueil
      $this->ctrlAccueil->accueil();
    }
  }
  catch (Exception $e) {
    $this->erreur($e->getMessage());
  }
}
  // Affiche une erreur
  private function erreur($msgErreur) {
    $vue = new Vue("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }
  // Recherche un paramètre dans un tableau
  private function getParametre($tableau, $nom) {
    if (isset($tableau[$nom])) {
      return $tableau[$nom];
    }
    else
      throw new Exception("Paramètre '$nom' absent");
  }
}
