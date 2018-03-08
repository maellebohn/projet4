<h1>Rédaction ou modification d'un chapitre :</h1>

<form method="POST" action="index.php?action=creer">

<div class="form-group">
  <label class="control-label" for="title">Titre</label>
  <div class="">
    <input id="title" class="form-control" name="title" type="text" <?php if(isset($title)){echo "value='".$title."'";}?> required/>
  </div>
</div>

<div class="form-group">
  <label class="control-label" for="author">Auteur</label>
  <div class="">
    <input id="title" class="form-control" name="author" type="text" placeholder="Jean Forteroche" <?php if(isset($username)){echo "value='".$username."'";}?> required/>
  </div>
</div>

<div class="form-group">
  <label class="control-label" for="text">Texte</label>
  <div class="">
    <textarea id="content" name="content" <?php if(isset($content)){echo "value='".$content."'";}?> required></textarea>
  </div>
</div>

<div class="form-group">
  <?php
    if(isset($id)){ ?>
        <input type="hidden" name="id" value="<?= $id ?>" />
    <?php }
   ?>
  <input type="submit" class="btn btn-primary" value="Créer ou modifier"/>
</div>

</form>
