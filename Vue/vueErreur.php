<?php ob_start() ?>
<p>Une erreur est survenue : <?php $msgErreur ?></p>
<?php $contenu = ob_get_clean(); ?>

<?php require 'template.php'; ?>
