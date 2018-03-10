<?php
// namespace projet4\Controleur;

require_once 'Modele/PostManager.php';
require_once 'Controleur/controleurAdmin.php';
require_once 'Vue/Vue.php';

class ControleurRedaction {
  private $post;
  private $ctrlAdmin;

  public function __construct(array $database) {
    $this->post = new PostManager($database);
    $this->ctrlAdmin = new ControleurAdmin($database);
    }
  //Affiche la page permettant de rédiger un post
  public function redaction(string $title=null, string $username=null, string $content=null, int $id=null) {
    if (empty($id)) {
      $vue=new Vue("Redaction");
      $vue->generer(array());
    }
    else {
      $vue = new Vue("Redaction");
      $vue->generer(array('title'=>$title, 'username'=>$username, 'content'=>$content, 'id'=>$id));
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
    $title=$post['title'];
    $username=$post['username'];
    $content=$post['content'];
    $id=$post['id'];
    $this->redaction($title, $username, $content, $id);
    }
}
?>
