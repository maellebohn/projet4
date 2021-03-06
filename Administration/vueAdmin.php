<?php ob_start();?>

  <h1>Administration</h1>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab" id="chapitres">Chapitres</a></li>
    <li><a href="#tab2" data-toggle="tab" id="commentaires">Commentaires</a></li>
  </ul>

  <div class="tab-content">

    <div class="tap-pane active" id="tab1">
      <table id="tab1-dt" class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Date</th>
            <th>Publication</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post): ?>
          <tr>
            <td><?= $post['title'] ?></td>
            <td><?= $post['content']?></td>
            <td><?= $post['date_creation']?></td>
            <td><?= '<a href="/index.php?action=modifier&id='.$post['id'].'">'; ?> <span class="fas fa-edit"></span></a><?= '<a href="/index.php?action=supprimer&id='.$post['id'].'">'; ?> <span class="fas fa-times"></span></a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="tap-pane" id="tab2">
      <table id="tab2-dt" class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Contenu</th>
            <th>Auteur</th>
            <th>Email</th>
            <th>Date</th>
            <th>Publication</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment): ?>
          <tr>
            <td><?= $comment['content']?></td>
            <td><?= $comment['author']?></td>
            <td><?= $comment['email']?></td>
            <td><?= $comment['date_publication']?></td>
            <td><?= '<a href="/index.php?action=delete&id='.$comment['id'].'">'; ?> <span class="fas fa-times"></span></a><?php if ($comment['signalement']==1) {echo'Signalé';}?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>

<div>
  <a class="btn btn-primary" href="/index.php?action=redaction"><span class="fas fa-plus"></span>Créer un nouveau chapitre</a>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require '/var/www/html/Vue/template2.php'; ?>
