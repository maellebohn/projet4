<?php
// namespace projet4\Controleur;

require_once 'Modele/PostManager.php';
require_once 'Modele/CommentManager.php';
require_once 'Vue/Vue.php';

class ControleurAdmin {
  private $post;
  private $comment;

  public function __construct(array $database) {
    $this->post = new PostManager($database);
    $this->comment = new CommentManager($database);
  }

  public function administration() {
    $posts = $this->post->getPosts();
    $comments = $this->comment->comments();
    $vue=new Vue("Admin");
    $vue->generer(array('posts'=>$posts,'comments'=>$comments));
  }

//Affiche la page d'administration après suppression d'un post
  public function supprimer(int $idPost) {
    $this->post->deletePost($idPost);
    $this->administration();
  }

//Affiche la page d'administration après suppression d'un commentaire
  public function supprimerComment(int $idComment) {
    $this->comment->deleteComment($idComment);
    $this->administration();
  }
}
?>
