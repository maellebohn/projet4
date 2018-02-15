
<?php
require '/var/www/html/Modele/Modele.php';

$username = "Jean Forteroche";
$password = password_hash("Louise@13", PASSWORD_DEFAULT);
$email = "bohnmaelle@gmail.com";
$role="adminuser";

$bdd = getBdd();
$adduser=$bdd->prepare( "INSERT INTO adminUser(username, password, email, role) VALUES (:username, :password, :email, :role);");
$adduser->execute(array(":username"=> $username, ":password"=> $password, ":email"=>$email, ":role"=>$role));
return $adduser;
?>
