<?php
// namespace projet4\Controleur;

require_once 'Modele/PostManager.php';
require_once 'Modele/CommentManager.php';
require_once 'Vue/Vue.php';

class ControleurPost {
  private $post;
  private $comment;
  private $message = false;

  public function __construct(array $database) {
    $this->post = new PostManager($database);
    $this->comment = new CommentManager($database);
  }

  // Affiche les détails sur un post
  public function post(int $idPost) {
    $post = $this->post->getPost($idPost);
    $comments = $this->comment->getComments($idPost);
    $lastposts = $this->post->getLastPosts();
    $vue=new Vue("Post");
    $vue->generer(array('post'=>$post,'comments'=>$comments, 'lastposts'=>$lastposts, 'message'=>$this->message));
  }

  //Affiche un nouveau commentaire à un post
  public function commenter(string $author,string $content,string $email,int $idPost) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) ==false) {
      $this->message=true;
      $this->post($idPost);
    } else {
      $this->comment->addComment($author, $content, $email, $idPost);
      $this->post($idPost);
    }
  }

  //Affichage de la page d'un post après signalement d'un commentaire
  public function signalement(int $idComment, int $idPost) {
    $this->comment->signal($idComment);
    $this->post($idPost);
  }
}
?>
