<?php //ini_set('display_errors', 0); ?>
<?php include 'includes/header.php'; ?>
 
<?php
	// Create DB Object
	$postdb = new Post();

    // Get all posts
    $posts = $postdb->getAllPosts();

    // Get all categories
    $categories = $postdb->getAllCategories();
?>

<?php if($posts) : ?>
	<?php foreach($posts as $post) :  ?>
		<div class="blog-post">
            <h2 class="blog-post-title"><?php echo htmlspecialchars($post->title); ?></h2>
            <p class="blog-post-meta">
                <?php echo formatDate($post->date); ?> by <a href="#"><?php echo htmlspecialchars($post->author); ?></a>
            </p>
			<p>
                <?php echo htmlspecialchars(shortenText($post->body)); ?>
            </p>
            <a class="readmore" href="post.php?id=<?php echo urlencode($post->id); ?>">Read More</a>
        </div><!-- /.blog-post -->
	<?php endforeach; ?>	  
       
<?php else : ?>
	<p>There are no posts yet</p>
<?php endif; ?>	
                

<?php include 'includes/footer.php'; ?>       

    



