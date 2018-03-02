
<?php
if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["new-password"])) {
  $username = htmlspecialchars($_POST["username"]);
  $new_password = htmlspecialchars($_POST["new-password"]);
  $password = htmlspecialchars($_POST["password"]);

  $result=connect($username);

  $isValid = password_verify($password, $result[0]);

  if ($isValid) {
    $newpassword = password_hash("$new_password", PASSWORD_DEFAULT);
    modifyPassword($newpassword, $username);
    header('Location: /index.php?action=connect');
    require '/var/www/html/Administration/vueAdmin.php';
  } else {
    // Autrement => message d'erreur
    $message=true;
    require '/var/www/html/Administration/vuePassword.php';
  }
} else {
  require '/var/www/html/Administration/vuePassword.php';
}
?>
