<?php

require_once 'config.php';
require_once 'classes/class.utitlity.php';
require_once 'classes/class.db.php';
require_once 'classes/class.user.php';

$db = new database();
$user = new user($db);

if($user->login($_POST['username'], $_POST['password'])) {
    header("Location:dashboard.php");
} else {
    header("Location:login.php?error=1");
}