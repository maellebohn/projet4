<?php
// Renvoie la liste des posts du blog
function getPosts() {
  // $bdd = getBdd();
  return $posts = getBdd()->query("select id, date_format(date_creation, '%d/%m/%Y') as date_creation, title, content from post order by id DESC");
  // return $posts;
}

// Renvoie la liste des 4 derniers posts du blog
function getLastPosts() {
  // $bdd = getBdd();
  return $lastposts = getBdd()->query("select id,date_format(date_creation, '%d/%m/%Y') as date_creation, title from post order by date_creation DESC limit 4");
  // return $lastposts;
}

// Renvoie les informations sur un post
function getPost($idPost) {
  // $bdd = getBdd();
  $post = getBdd()->prepare("select post.id,date_format(post.date_creation, '%d/%m/%Y') as date_creation, post.title, post.content, post.author,adminUser.username from post join adminUser where post.author LIKE adminUser.id AND post.id=:id;");
  $post->execute(array(":id"=>$idPost));
  if ($post->rowCount() == 1)
    return $post->fetch();  // Accès à la première ligne de résultat
  else
    throw new Exception("Aucun post ne correspond à l'identifiant '$idPost'");
}

// Renvoie la liste des commentaires associés à un post
function getComments($idPost) {
  // $bdd = getBdd();
  $comments = getBdd()->prepare("select id, date_format(date_publication, '%d/%m/%Y à %Hh%imin%ss') as date_publication, author, content, email from comment where post=:id;");
  $comments->execute(array(":id"=>$idPost));
  return $comments->fetchAll();
}

//Ajoute un commentaire dans la table
function addComment($author, $content, $email, $idPost) {
  // $bdd = getBdd();
  $comments = getBdd()->prepare('insert into comment (date_publication, author, content, email, post) values(NOW(),:author,:content,:email,:post);');
  $comments->execute(array(":author"=> $author, ":content"=> $content, ":email"=>$email, ":post"=>$idPost));
  // return $comments->fetch();
}

// Mise à jour de la table après signalement d'un commentaire
function signal($idComment) {
  // $bdd = getBdd();
  $comments = getBdd()->prepare('update comment set signalement=1 where id=:id;');
  $comments->execute(array(":id"=> $idComment));
  // return $comments->fetch();
}

//Récupère le mot de passe et l'id correspondant à un username si il existe
function connect($username) {
  // $bdd = getBdd();
  $connect = getBdd()->prepare('select password, id from adminUser where username=:username;');
  $connect->execute(array(":username"=>$username));
  return $result=$connect->fetch();
  // return $result;
}

//Ajoute un post dans la table
function addPost($title, $content, $author) {
  // $bdd = getBdd();
  $posts = getBdd()->prepare('insert into post (title, content, date_creation, author) values(:title, :content, NOW(), 5);');
  $posts->execute(array(":title"=>$title, ":content"=> $content));
  // return $posts->fetch();
}

//Mise à jour de la table après modification d'un post
function modifyPost($title, $content, $idPost) {
  // $bdd = getBdd();
  $posts = getBdd()->prepare('update post set title= :title, content=:content where id=:id;');
  $posts->execute(array(":title"=>$title, ":content"=> $content, ":id"=> $idPost));
  // return $posts->fetch();
}

//Suppression d'un post dans la table
function deletePost($idPost) {
  // $bdd = getBdd();
  $posts = getBdd()->prepare('delete from post where id=:id;');
  $posts->execute(array(":id"=> $idPost));
  // return $posts->fetch();
}

// Renvoie la liste des commentaires du blog
function comments() {
  // $bdd = getBdd();
  return $comments = getBdd()->query("select id, author, content, date_format(date_publication, '%d/%m/%Y') as date_publication, email, post, signalement from comment order by id DESC");
  // return $comments;
}

//Suppression d'un commentaire dans la table
function deleteComment($idComment) {
  // $bdd = getBdd();
  $comments = getBdd()->prepare('delete from comment where id=:id;');
  $comments->execute(array(":id"=> $idComment));
  // return $comments->fetch();
}

//Mise à jour de la table après modification du mot de passe
function modifyPassword($newpassword, $username) {
  // $bdd = getBdd();
  $modifyPassword = getBdd()->prepare('update adminUser set password=:password where username=:username;');
  $modifyPassword->execute(array(":password"=>$newpassword, ":username"=> $username));
}

// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd() {
  return $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'jean','Louise@13', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  // ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
  // return $bdd;
}
