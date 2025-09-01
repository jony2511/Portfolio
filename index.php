<?php
session_start();
require_once __DIR__.'/config.php';
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tariful Islam Jony</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header><h1>Welcome</h1></header>
  <main>
    <?php if(isset($_SESSION['user'])): ?>
      <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>.</p>
      <p><a href="admin.php">Go to Admin</a> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
      <p><a href="login.php">Login</a></p>
    <?php endif; ?>
  </main>
</body>
</html>