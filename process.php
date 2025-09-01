<?php
session_start();
if(($_POST['username'] ?? '')==='admin' && ($_POST['password'] ?? '')==='admin'){
    $_SESSION['user']='admin';
    header('Location: admin.php'); exit;
}
header('Location: login.php');