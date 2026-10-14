<?php require_once __DIR__ . '/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title : 'LensHub' ?> | LensHub Cameras</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav class="navbar">
  <a href="/" class="logo">📷 LensHub</a>
  <div class="links">
    <a href="/">Home</a>
    <a href="/#products">Cameras</a>
    <a href="/dashboard">Dashboard</a>
  </div>
</nav>
