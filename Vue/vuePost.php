<div class="wrap-post">
  <div class="header-post text-center">
    <div class="title-post"><h3><?= $post['title'] ?></h3>
    <div class=info-post>Publié le <?= $post['date_creation'] ?></div>
    </div>
  </div>
  <div class="content-post">
    <div class="content"><?= $post['content'] ?></div>
  </div>
</div>

<div  class="text-center"><span id="icone" class="fas fa-user-secret"></span></div>

<div class="comments wrap-post">
  <div class="header-post">
    <div class="title-post"><h3>Vos avis et commentaires</h3></div>
  </div>
  <hr>
  <div id="listComment">
  <?php foreach ($comments as $comment): ?>
  	<div class="content-post">
      <p><?= $comment['content'] ?></p>
      <div class="pull-right">
        <p>Par <?= $comment['author'] ?> le <?= $comment['date_publication'] ?></p>
  	  </div>
      <p><a id="signalement" href="<?= "index.php?action=signaler&id=".$comment['id']."&post=".$post['id'] ?>">Signaler ce commentaire</a></p>
  	</div>
    <hr>
  <?php endforeach; ?>
  </div>
</div>

<div  class="text-center"><span id="icone" class="fas fa-user-secret"></span></div>

<div>
  <h4> Ajouter votre avis ou commentaire</h4>
	<form method="POST" action="index.php?action=commenter">

		<div class="form-group">
			<input id="auteur" class="form-control" name="auteur" type="text" placeholder="Votre nom" required />
		</div>

    <div class="form-group">
			<input id="mail" class="form-control" name="email" type="text" placeholder="Votre email" required />
      <?php if ($message==true) {
        echo '<div class="error">Cette adresse email n\'est pas valide</div>';
      } ?>
		</div>

		<div class="form-group">
			<textarea id="txtCommentaire" class="form-control" name="contenu" rows="4" placeholder="Votre commentaire" required></textarea>
		</div>

		<div class="form-group">
			<input type="hidden" name="id" value="<?= $post['id'] ?>" />
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Commenter" />
		</div>

	</form>
</div>
