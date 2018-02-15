<?php ob_start(); ?>
<div class="row">
  <h2 class="text-center" id="titre_presentation">Bienvenue sur mon blog pour découvrir mon dernier roman !</h2>
  <p>Il représente l'aboutissement de 2 ans de travail acharné, que je publierai ici au fur et à mesure de l'écriture pour obtenir votre avis en avant-première !</br>
    Jean Forteroche
  </p>
  <h2 id="titre_chapitres">Tous les chapitres</h2>
  <hr>
</div>

<?php foreach ($posts as $post): ?>
  <div class="wrap-post text-center">
    <div class="header-post">
      <div class="title-post"><h3><?php $post['title'] ?></h3>
      <div class=info-post>Publié le <?php $post['date_creation'] ?></div>
      </div>
    </div>
    <div class="content-post">
      <div class="content"><?php substr($post['content'],0,225) ?>...</div>
      <div class="fade-content"><a href="<?php "index.php?action=post&id=" . $post['id'] ?>">Lire la suite</a></div>
    </div>
  </div>

  <div  class="text-center"><span id="icone" class="fas fa-user-secret"></span></div>

<?php endforeach; ?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'template.php'; ?>
