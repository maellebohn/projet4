
<?php
session_start();
require 'Controleur/controleur.php';
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'post') {
            if (isset($_GET['id'])) {
                $idPost = intval($_GET['id']);
                if ($idPost != 0) {
                    post($idPost);
                }
                else
                    throw new Exception("Identifiant de post non valide");
            }
            else
                throw new Exception("Identifiant de post non défini");
        }
        elseif ($_GET['action'] == 'commenter') {
          $author=htmlspecialchars($_POST['auteur']);
          $content=htmlspecialchars(nl2br($_POST['contenu']));
          $email=htmlspecialchars($_POST['email']);
          $idPost= $_POST['id'];
          commenter($author, $content, $email, $idPost);
        }
        elseif ($_GET['action'] == 'login') {
          connexion();
        }
        elseif ($_GET['action'] == 'signaler') {
          $idComment= intval($_GET['id']);
          signalement($idComment);
        }
        elseif ($_GET['action'] == 'connect') {
          if (!empty($_SESSION['username'])){
            administration();
          }
          else connexion();
        }
        elseif ($_GET['action'] == 'modifyUser') {
          if (!empty($_SESSION['username'])){
            modifyUser();
          }
          else connexion();
        }
        elseif ($_GET['action'] == 'redaction') {
          if (!empty($_SESSION['username'])){
            redaction();
          }
          else connexion();
        }
        elseif ($_GET['action'] == 'deconnect') {
          deconnexion();
        }
        elseif ($_GET['action'] == 'creer') {
          if (!empty($_SESSION['username'])){
            if (empty($_POST['id'])){
              $title=htmlspecialchars($_POST['title']);
              $content=nl2br($_POST['content']);
              $author=htmlspecialchars($_POST['author']);
              poster($title, $content, $author);
            }
            else {
              $title=htmlspecialchars($_POST['title']);
              $content=nl2br($_POST['content']);
              $idPost=$_POST['id'];
              modifier($title,$content,$idPost);
            }
          }
          else connexion();
        }
        elseif ($_GET['action'] == 'supprimer') {
          if (!empty($_SESSION['username'])){
            $idPost = intval($_GET['id']);
            supprimer($idPost);
          }
          else connexion();
        }
        elseif ($_GET['action'] == 'delete') {
          if (!empty($_SESSION['username'])){
            $idComment = intval($_GET['id']);
            supprimerComment($idComment);
          }
          else connexion();
        }
        elseif ($_GET['action'] == 'modifier') {
          if (!empty($_SESSION['username'])){
            $idPost = intval($_GET['id']);
            recup($idPost);
          }
          else connexion();
        }
        else
            throw new Exception("Action non valide");
    }
    else {  // aucune action définie : affichage de l'accueil
        accueil();
    }
}
catch (Exception $e) {
    erreur($e->getMessage());
}
