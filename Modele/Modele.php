<?php
// Renvoie la liste des posts du blog
function getPosts() {
  // $bdd = getBdd();
  $posts = getBdd()->query("select id, date_format(date_creation, '%d/%m/%Y') as date_creation, title, content from post order by id DESC");
  return $posts;
}

// Renvoie la liste des 4 derniers posts du blog
function getLastPosts() {
  // $bdd = getBdd();
  $lastposts = getBdd()->query("select id,date_format(date_creation, '%d/%m/%Y') as date_creation, title from post order by date_creation DESC limit 4");
  return $lastposts;
}

// Renvoie les informations sur un post
function getPost($idPost) {
  // $bdd = getBdd();
  $post = getBdd()->prepare("select id,date_format(date_creation, '%d/%m/%Y') as date_creation, title, content from post where id=:id;");
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
  return $comments;
}

//Ajoute un commentaire dans la base
function addcomment($author, $content, $email, $idPost) {
  // $bdd = getBdd();
  $comments = getBdd()->prepare('insert into comment (date_publication, author, content, email, post) values(NOW(),:author,:content,:email,:post);');
  $comments->execute(array(":author"=> $author, ":content"=> $content, ":email"=>$email, ":post"=>$idPost));
}

//Récupère le mot de passe et l'id correspondant à un username si il existe
function connect($username) {
  // $bdd = getBdd();
  $connect = getBdd()->prepare('select password, id from adminUser where username=:username;');
  $connect->execute(array(":username"=>$username));
  $result=$connect->fetch();
  return $result;
}

// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd() {
  $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'jean','Louise@13', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  return $bdd;
}
