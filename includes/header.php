<?php include 'config/config.php'; ?>
<?php include 'helpers/format_helper.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php include 'libraries/Post.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <title>Blog</title>
</head> 

<body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item <?= ($activepage == 'index') ? 'active' : ''; ?>" href="index.php">Home</a>
          <a class="blog-nav-item <?= ($activepage == 'posts') ? 'active' : ''; ?>" href="posts.php">All Posts</a>
          <a class="blog-nav-item float-right" href="admin/login.php">Admin</a>
        </nav>

      </div>
    </div>

    <div class="container">
      
      <div class="blog-header">
        <div class="logo"><img src="images/logo.png"></div>
        <h1 class="blog-title">PHP Lovers Blog</h1>
        <p class="lead blog-description">PHP News, tutorials, videos & more</p>
      </div>

      <div class="row">
          <div class="col-sm-8 blog-main">