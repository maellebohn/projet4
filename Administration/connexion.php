
<?php
if (!empty($_POST["username"]) && !empty($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result=connect($username);

  $isValid = password_verify($password, $result[0]);

  if ($isValid) {
    $_SESSION['role'] = adminuser;
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $result[1];
    require '/var/www/html/Administration/vueAdmin.php';
  } else {
    // Autrement => message d'erreur
    $message=true;
    require '/var/www/html/Vue/vueLogin.php';
  }
} else {
  require '/var/www/html/Vue/vueLogin.php';
}
?>
