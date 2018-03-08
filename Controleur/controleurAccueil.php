<?php
// namespace projet4\Controleur;

require_once 'Modele/PostManager.php';
require_once 'Vue/Vue.php';

class ControleurAccueil {
  private $post;

  public function __construct() {
    $this->post = new PostManager();
    }

  // Affiche la liste de tous les posts du blog
  public function accueil() {
    $posts = $this->post->getPosts();
    $lastposts = $this->post->getLastPosts();
    $vue=new Vue("Accueil");
    $vue->generer(array('posts'=>$posts, 'lastposts'=>$lastposts));
  }
}
