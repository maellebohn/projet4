<?php
// namespace projet4\Modele;

require_once 'Modele/Manager.php';

class PostManager extends Manager
{
  private $database;

  public function __construct(array $database) {
    $this->database = $database;
  }

  // Renvoie la liste des posts du blog
  public function getPosts() {
    // $bdd = getBdd();
    return $posts = $this->getBdd($this->database)->query("select id, date_format(date_creation, '%d/%m/%Y') as date_creation, title, content from post order by id DESC");
    // return $posts;
  }

  // Renvoie la liste des 4 derniers posts du blog
  public function getLastPosts() {
    // $bdd = getBdd();
    $lastposts = $this->getBdd($this->database)->query("select id,date_format(date_creation, '%d/%m/%Y') as date_creation, title from post order by date_creation DESC limit 4");
    return $lastposts->fetchAll();
  }

  // Renvoie les informations sur un post
  public function getPost(int $idPost) {
    // $bdd = getBdd();
    $post = $this->getBdd($this->database)->prepare("select post.id,date_format(post.date_creation, '%d/%m/%Y') as date_creation, post.title, post.content, post.author,adminUser.username from post join adminUser where post.author LIKE adminUser.id AND post.id=:id;");
    $post->execute(array(":id"=>$idPost));
    if ($post->rowCount() == 1)
      return $post->fetch();  // Accès à la première ligne de résultat
    else
      throw new Exception("Aucun post ne correspond à l'identifiant '$idPost'");
  }

  //Ajoute un post dans la table
  public function addPost(string $title, string $content, int $id) {
    // $bdd = getBdd();
    $posts = $this->getBdd($this->database)->prepare('insert into post (title, content, date_creation, author) values(:title, :content, NOW(), :author);');
    $posts->execute(array(":title"=>$title, ":content"=> $content, ":author"=> $id));
    // return $posts->fetch();
  }

  //Mise à jour de la table après modification d'un post
  public function modifyPost(string $title, string $content, int $idPost) {
    // $bdd = getBdd();
    $posts = $this->getBdd($this->database)->prepare('update post set title= :title, content=:content where id=:id;');
    $posts->execute(array(":title"=>$title, ":content"=> $content, ":id"=> $idPost));
  }

  //Suppression d'un post dans la table
  public function deletePost(int $idPost) {
    // $bdd = getBdd();
    $posts = $this->getBdd($this->database)->prepare('delete from post where id=:id;');
    $posts->execute(array(":id"=> $idPost));
  }
}
