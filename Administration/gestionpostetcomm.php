
<?php

if (isset($_GET['modifier_billets'])) // Si on demande de modifier une news.
{
    // On protège la variable « modifier_billets » pour éviter une faille SQL.
    //$_GET['modifier_billets'] = ($_GET['modifier_billets']));
    // On récupère les informations de la news correspondante.

    $req = $bdd->query('SELECT * FROM billets WHERE id=\'' . $_GET['modifier_billets'] . '\'');
    while($donnees = $req->fetch()){

    // On place le titre et le contenu dans des variables simples.
    $titre = $donnees['titre'];
    $auteur = $donnees['auteur'];
    $contenu = $donnees['contenu'];
    $id_billets = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification.
    }
}
else // C'est qu'on rédige une nouvelle news.
{
    // Les variables $titre et $contenu sont vides, puisque c'est une nouvelle news.
    $titre = '';
    $auteur = '';
    $contenu = '';
    $id_billets = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification.
}


//-----------------------------------------------------
// Vérification 1 : est-ce qu'on veut poster une news ?
//-----------------------------------------------------
if (isset($_POST['titre']) AND isset($_POST['auteur']) AND isset($_POST['contenu']))
{
    $titre = ($_POST['titre']);
    $auteur = ($_POST['auteur']);
    $contenu = ($_POST['contenu']);
    // On vérifie si c'est une modification de news ou non.
    if ($_POST['id_billets'] == 0)
    {
        // Ce n'est pas une modification, on crée une nouvelle entrée dans la table.

       $req = $bdd->prepare('INSERT INTO billets(titre, auteur, contenu, date_creation) VALUES(:titre, :auteur, :contenu, NOW())');
                        $req->execute(array(

                        ':titre' => $_POST['titre'],
                        ':auteur' => $_POST['auteur'],
                        ':contenu' => $_POST['contenu']));

    }
    else
    {
        // On protège la variable "id_news" pour éviter une faille SQL.
        //$_POST['id_billets'] = ($_POST['id_billets']);
        // C'est une modification, on met juste à jour le titre et le contenu.

        $bdd->execute("UPDATE billets SET titre='" . $titre . "', auteur='" . $auteur . "', contenu='" . $contenu . "' WHERE id='" . $_POST['id_billets'] . "'");

    }
}
//--------------------------------------------------------
// Vérification 2 : est-ce qu'on veut supprimer une news ?
//--------------------------------------------------------
if (isset($_GET['supprimer_billets'])) // Si l'on demande de supprimer une news.
{
 // Alors on supprime la news correspondante.
 // On protège la variable « id_billets » pour éviter une faille SQL.
 //$_GET['supprimer_billets'] = ($_GET['supprimer_billets']);

     $bdd->exec('DELETE FROM billets WHERE id=\'' . $_GET['supprimer_billets'] . '\'');
}
?>
