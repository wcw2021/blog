
<?php include 'includes/header.php'; ?>

<?php
    
    // check if login or not
    if(!isLoggedIn()){
        header("Location: login.php");
        exit();
    }
      
	// Create DB Object
	$postdb = new Post();

    // Get all posts include category name for admin
    $posts = $postdb->getAllPostsForAdmin();

    // Get all categories
    $categories = $postdb->getAllCategories();

?>


<table class="table table-striped">
	<tr>
		<th>Post ID#</th>
		<th>Post Title</th>
		<th>Category</th>
		<th>Author</th>
		<th>Date</th>
	</tr>

	<?php foreach($posts as $post) :  ?>
		<tr>
			<td><?php echo htmlspecialchars($post->id); ?></td>
			<td><a href="edit_post.php?id=<?php echo urlencode($post->id); ?>"><?php echo htmlspecialchars($post->title); ?></a></td>
			<td><?php echo htmlspecialchars($post->name); ?></td>
			<td><?php echo htmlspecialchars($post->author); ?></td>
			<td><?php echo formatDate($post->date); ?></td>
		</tr>
	<?php endforeach; ?>
</table>


<table class="table table-striped">
	<tr>
		<th>Category ID#</th>
		<th>Category Name</th>
	</tr>

	<?php foreach($categories as $category) : ?>
		<tr>
			<td><?php echo htmlspecialchars($category->id); ?></td>
			<td><a href="edit_category.php?id=<?php echo urlencode($category->id); ?>"><?php echo htmlspecialchars($category->name); ?></a></td>			
		</tr>
	<?php endforeach; ?>
</table>


<?php include 'includes/footer.php'; ?>       

    



