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
  $comments = addComment($author, $content, $email, $idPost);
  header('Location: /index.php?action=post&id='.$_POST['id'].'');
  require 'Vue/vuePost.php';
}

//Affichage de la page d'un post après signalement d'un commentaire
function signalement($idComment) {
  signal($idComment);
  require 'Vue/vuePost.php';
}

//Affiche la page permettant de se connecter au back
function connexion() {
  require 'Administration/connexion.php';
}

function administration() {
  $posts = getPosts();
  $comments = comments();
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

//Affiche la page d'administration après ajout d'un post
function poster($title, $content, $author) {
  $posts= addPost($title, $content, $author);
  header('Location: /index.php?action=connect');
  require 'Administration/vueAdmin.php';
}

//Affiche la page d'administration après suppression d'un post
function supprimer($idPost) {
  deletePost($idPost);
  header('Location: /index.php?action=connect');
  require 'Administration/vueAdmin.php';
}

//Affiche la page d'administration après suppression d'un commentaire
function supprimerComment($idComment) {
  deleteComment($idComment);
  header('Location: /index.php?action=connect');
  require 'Administration/vueAdmin.php';
}

//Affiche la page d'administration après modification d'un post
function modifier($title,$content,$idPost) {
  modifyPost($title, $content, $idPost);
  header('Location: /index.php?action=connect');
  require 'Administration/vueAdmin.php';
}

// Affiche la page de redaction après clic sur le bouton modifier
function recup($idPost) {
  $post = getPost($idPost);
  $title=$post['title'];
  $content=$post['content'];
  $username=$post['username'];
  $id=$post['id'];
  require 'Administration/vueRedaction.php';
}

function modifyUser() {
  require 'Administration/modifyPassword.php';
}

// Affiche une erreur
function erreur($msgErreur) {
    require 'Vue/vueErreur.php';
}
?>
