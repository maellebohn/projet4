<?php
// namespace projet4\Controleur;

require_once 'Modele/PostManager.php';
require_once 'Controleur/controleurAdmin.php';
require_once 'Vue/Vue.php';

class ControleurRedaction {
  private $post;
  private $ctrlAdmin;

  public function __construct() {
    $this->post = new PostManager();
    $this-> ctrlAdmin=new ControleurAdmin();
    }
  //Affiche la page permettant de rédiger un post
  public function redaction(int $idPost=null) {
    if ($idPost!=null) {
      $vue=new Vue("Redaction");
      $vue->generer(array('post'=>$post));
    }
    else {
      $vue=new Vue("Redaction");
      $vue->generer(array());
    }
  }

  //Affiche la page d'administration après ajout d'un post
  public function poster(string $title,string $content,int $id) {
    $this->post->addPost($title, $content, $id);
    $this->ctrlAdmin->administration();
  }

  //Affiche la page d'administration après modification d'un post
  public function modifier(string $title,string $content,int $idPost) {
    $this->post->modifyPost($title, $content, $idPost);
    $this->ctrlAdmin->administration();
  }

  // Affiche la page de redaction après clic sur le bouton modifier
  public function recup(int $idPost) {
    $post = $this->post->getPost($idPost);
    $title=$this->$post['title'];
    $content=$this->$post['content'];
    $username=$this->$post['username'];
    $id=$this->$post['id'];
    $this->redaction($idPost);
    }
}
?>
