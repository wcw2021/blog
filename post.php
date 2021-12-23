
<?php include 'includes/header.php'; ?>

<?php
	$id = (isset($_GET['id'])) ? (int) $_GET['id'] : 0;

	// Create DB Object
	$postdb = new Post();

    // Get single post
    $post = $postdb->getPost($id);
	
    // Get all categories
    $categories = $postdb->getAllCategories();

?>

<?php if($post) : ?>
    <div class="blog-post">
        <h2 class="blog-post-title"><?php echo htmlspecialchars($post->title); ?></h2>
        <p class="blog-post-meta">
            <?php echo formatDate($post->date); ?> by <a href="#"><?php echo htmlspecialchars($post->author); ?></a>
        </p>
        <p>
            <?php echo htmlspecialchars($post->body); ?>
        </p>
    </div><!-- /.blog-post -->	
<?php else : ?>
	<p>No post found</p>
<?php endif; ?>	

<?php include 'includes/footer.php'; ?>





