<?php
// namespace projet4\Modele;

require_once 'Modele/Manager.php';

class CommentManager extends Manager
{
  // Renvoie la liste des commentaires associés à un post
  public function getComments(int $idPost) {
    // $bdd = getBdd();
    $comments = $this->getBdd()->prepare("select id, date_format(date_publication, '%d/%m/%Y à %Hh%imin%ss') as date_publication, author, content, email from comment where post=:id;");
    $comments->execute(array(":id"=>$idPost));
    return $comments->fetchAll();
  }

  //Ajoute un commentaire dans la table
  public function addComment(string $author, string $content, string $email, int $idPost) {
    // $bdd = getBdd();
    $comments = $this->getBdd()->prepare('insert into comment (date_publication, author, content, email, post) values(NOW(),:author,:content,:email,:post);');
    $comments->execute(array(":author"=> $author, ":content"=> $content, ":email"=>$email, ":post"=>$idPost));
    // return $comments->fetch();
  }

  // Mise à jour de la table après signalement d'un commentaire
  public function signal(int $idComment) {
    // $bdd = getBdd();
    $comments = $this->getBdd()->prepare('update comment set signalement=1 where id=:id;');
    $comments->execute(array(":id"=> $idComment));
  }

  // Renvoie la liste des commentaires du blog
  public function comments() {
    // $bdd = getBdd();
    return $comments = $this->getBdd()->query("select id, author, content, date_format(date_publication, '%d/%m/%Y') as date_publication, email, post, signalement from comment order by id DESC");
    // return $comments;
  }

  //Suppression d'un commentaire dans la table
  public function deleteComment(int $idComment) {
    // $bdd = getBdd();
    $comments = $this->getBdd()->prepare('delete from comment where id=:id;');
    $comments->execute(array(":id"=> $idComment));
  }
}
