<?php ob_start(); ?>

<h1>Rédaction d'un chapitre :</h1>

<form method=POST>

<div class="form-group">
  <label class="control-label" for="title">Titre</label>
  <div class="">
    <input id="title" class="form-control" name="title" type="text" required/>
  </div>
</div>

<div class="form-group">
  <label class="control-label" for="author">Auteur</label>
  <div class="">
    <input id="title" class="form-control" name="author" type="text" placeholder="Jean Forteroche" required/>
  </div>
</div>

<div class="form-group">
  <label class="control-label" for="text">Texte</label>
  <div class="">
    <textarea id="content" name="content"></textarea>
  </div>
</div>

<div class="form-group">
  <input type="submit" class="btn btn-primary" value="Créer"/>
</div>

</form>

<?php $contenu = ob_get_clean(); ?>

<?php require '/var/www/html/Vue/template2.php'; ?>
