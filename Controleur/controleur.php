<?php
require 'Modele/Modele.php';

// Affiche la liste de tous les posts du blog
function accueil() {
    $posts = getPosts();
    $lastposts = getLastPosts();
    require 'Vue/vueAccueil.php';
}

// Affiche les détails sur un post
function post($idPost) {
    $post = getPost($idPost);
    $comments = getComments($idPost);
    $lastposts = getLastPosts();
    require 'Vue/vuePost.php';
}

//Affiche un nouveau commentaire à un post
function commenter($author, $content, $email, $idPost) {
  $comments = addcomment($author, $content, $email, $idPost);
  header('Location: /index.php?action=post&id='.$_POST['id'].'');
  require 'Vue/vuePost.php';
}

//Affiche la page permettant de se connecter au back
function connexion() {
  require 'Administration/connexion.php';
}

function administration() {
  require 'Administration/vueAdmin.php';
}

//Affiche la page permettant de rédiger un post
function redaction() {
  require 'Administration/vueRedaction.php';
}

//Initialise la deconnexion et renvoie sur la page de login
function deconnexion() {
  $_SESSION = array();
  session_destroy();
  unset($_SESSION);
  require 'Administration/connexion.php';
}

// Affiche une erreur
function erreur($msgErreur) {
    require 'Vue/vueErreur.php';
}
?>
