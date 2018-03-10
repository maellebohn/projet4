<?php
// namespace projet4;

require 'config.php';
require 'Routeur.php';
$routeur = new Routeur($database);
$routeur->routerRequete();
