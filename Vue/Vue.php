<?php
// namespace projet4\Vue;

class Vue {
  // Nom du fichier associé à la vue
  private $fichier;

  public function __construct($action) {
    // Détermination du nom du fichier vue à partir de l'action
    $this->fichier = "Vue/vue" . $action . ".php";
  }

  // Génère et affiche la vue
  public function generer($donnees) {
    // Génération de la partie spécifique de la vue
    $contenu = $this->genererFichier($this->fichier, $donnees);
    // Génération du gabarit commun utilisant la partie spécifique
    if ($this->fichier=="Vue/vueAccueil.php" or $this->fichier=="Vue/vuePost.php") {
      $donnees["contenu"] = $contenu;
      $vue = $this->genererFichier('Vue/template.php', $donnees);
    } else {
      $donnees["contenu"] = $contenu;
      $vue = $this->genererFichier('Vue/template2.php', $donnees);
    }
    // Renvoi de la vue au navigateur
    echo $vue;
  }

  // Génère un fichier vue et renvoie le résultat produit
  private function genererFichier($fichier, $donnees) {
    if (file_exists($fichier)) {
      // Rend les éléments du tableau $donnees accessibles dans la vue
      extract($donnees);
      // Démarrage de la temporisation de sortie
      ob_start();
      // Inclut le fichier vue
      // Son résultat est placé dans le tampon de sortie
      require $fichier;
      // Arrêt de la temporisation et renvoi du tampon de sortie
      return ob_get_clean();
    }
    else {
      throw new Exception("Fichier '$fichier' introuvable");
    }
  }
}
