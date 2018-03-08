<?php
// namespace projet4\Controleur;

require_once 'Modele/PostManager.php';
require_once 'Modele/CommentManager.php';
require_once 'Vue/Vue.php';

class ControleurPost {
  private $post;
  private $comment;

  public function __construct() {
    $this->post = new PostManager();
    $this->comment = new CommentManager();
  }

  // Affiche les détails sur un post
  public function post(int $idPost) {
    $post = $this->post->getPost($idPost);
    $comments = $this->comment->getComments($idPost);
    $lastposts = $this->post->getLastPosts();
    $vue=new Vue("Post");
    $vue->generer(array('post'=>$post,'comments'=>$comments, 'lastposts'=>$lastposts));
  }

  //Affiche un nouveau commentaire à un post
  public function commenter(string $author,string $content,string $email,int $idPost) {
    // if (filter_var($email, FILTER_VALIDATE_EMAIL) !==false) {
    // echo "Cette ($email) adresse email est considérée comme valide.";
    // }
    $this->comment->addComment($author, $content, $email, $idPost);
    $this->post($idPost);
  }

  //Affichage de la page d'un post après signalement d'un commentaire
  public function signalement(int $idComment) {
    $this->comment->signal($idComment);
    $this->post($idPost);
  }
}
?>
