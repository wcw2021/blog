<?php include '../config/config.php'; ?>
<?php include '../helpers/format_helper.php'; ?>
<?php include '../helpers/session_helper.php'; ?>
<?php include '../libraries/Database.php'; ?>
<?php include '../libraries/Post.php'; ?>
<?php include '../libraries/User.php'; ?>

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

    <link rel="stylesheet" href="../css/style.css">

    <title>Admin</title>
</head>

<body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item <?= ($activepage == 'index') ? 'active' : ''; ?>" href="index.php">Dashboard</a>
          <a class="blog-nav-item <?= ($activepage == 'add_post') ? 'active' : ''; ?>" href="add_post.php">Add Post</a>
                <a class="blog-nav-item <?= ($activepage == 'add_category') ? 'active' : ''; ?>" href="add_category.php">Add Category</a>
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <a class="blog-nav-item float-right" href="logout.php">Logout</a>
                <?php else : ?>
                    <a class="blog-nav-item float-right" href="login.php">Login</a>
                <?php endif; ?>
                <a class="blog-nav-item float-right" href="../index.php">Visit Blog</a>
            
        </nav>
      </div>
    </div>

    <div class="container">

        <div class="blog-header">
            <h2>Admin Area</h2>
        </div>

        <div class="row">
        <div class="col-sm-12 blog-main">

            <?php flash('post_message'); ?>
            <?php flash('category_message'); ?>



