<?php //ini_set('display_errors', 0); ?>
<?php include 'includes/header.php'; ?>

<?php
	// Create DB Object
	$postdb = new Post();

    // Get all categories for display categories in footer
    $categories = $postdb->getAllCategories();


    // filter posts by category id
    $category_id = (isset($_GET['category'])) ? (int) $_GET['category'] : 0;

    if($category_id){
        // Get all posts filter by category
        $posts = $postdb->getPostsByCategory($category_id);
    } else {
		// Get all posts
        $posts = $postdb->getAllPosts();
	}

?>

<?php if($posts) : ?>
    <?php // var_dump($posts); ?>
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

    
 
       
   

    



