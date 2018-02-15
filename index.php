
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
        else if ($_GET['action'] == 'commenter') {
          $author=$_POST['auteur'];
          $content=nl2br($_POST['contenu']);
          $email=$_POST['email'];
          $idPost= $_POST['id'];
          commenter($author, $content, $email, $idPost);
        }
        else if ($_GET['action'] == 'login') {
          connexion();
        }
        else if ($_GET['action'] == 'connect') {
          if (!empty($_SESSION['username'])){
            administration();
          }
          else connexion();
        }
        else if ($_GET['action'] == 'redaction') {
          if (!empty($_SESSION['username'])){
            redaction();
          }
          else connexion();
        }
        else if ($_GET['action'] == 'deconnect') {
          deconnexion();
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
