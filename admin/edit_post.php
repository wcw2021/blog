<?php include 'includes/header.php'; ?>

<?php

    // check if login or not
    if(!isLoggedIn()){
        header("Location: login.php");
        exit();
    }

	$id = (isset($_GET['id'])) ? (int) $_GET['id'] : 0;

	// Create DB Object
	$postdb = new Post();

    // Get single post
    $post = $postdb->getPost($id);
	
    // Get all categories
    $categories = $postdb->getAllCategories();

?>

<?php

    // Update Post
	if(isset($_POST['submit'])){
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
		$data =[
          'id' => $id,
          'title' => trim($_POST['title']),
          'body' => $_POST['body'],
          'category' => $_POST['category'],
          'author' => trim($_POST['author']),
          'tags' => trim($_POST['tags']),
          'title_err' => '',
          'body_err' => '',
          'author_err' => ''
        ];

        // Validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body text';
        }
        if(empty($data['author'])){
          $data['author_err'] = 'Please enter author name';
        }

        // Make sure no errors
        if(empty($data['title_err']) && empty($data['body_err']) && empty($data['author_err']) ){
          
            if( $postdb->updatePost($data) ){
                flash('post_message', 'Post Updated');
                header("Location: index.php");
                exit();
            } else {
                die('Something went wrong');
            }
        }

	}else {

        // Init data
        $data = [
            'title_err' => '',
            'body_err' => '',
            'author_err' => ''
        ];
    }

?>

<?php

    // Delete Post
	if(isset($_POST['delete'])){

        if( $postdb->deletePost($id) ){
            flash('post_message', 'Post Deleted');
            header("Location: index.php");
            exit();
        } else {
            die('Something went wrong');
        }

	}

?>


<?php if($post) : ?>
    <form method="post" action="edit_post.php?id=<?php echo urlencode($id); ?>">
        <div class="form-group">
            <label>Post Title: <sup>*</sup></label>
            <input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo htmlspecialchars($post->title) ?>">
        </div>

        <div class="form-group">
            <label>Post Body: <sup>*</sup></label>
            <textarea name="body" class="form-control" placeholder="Enter Post Body" rows="5"> <?php echo htmlspecialchars($post->body) ?> </textarea>
        </div>

        <div class="form-group">
            <label>Category: <sup>*</sup></label>
            <select name="category" class="form-control">
                <?php foreach($categories as $category) :  ?>
                    <?php 
                        if( urlencode($category->id) == urlencode($post->category) ){
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                    ?>	
                    <option value="<?php echo urlencode($category->id); ?>" <?php echo $selected; ?> >
                        <?php echo htmlspecialchars($category->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Author: <sup>*</sup></label>
            <input name="author" type="text" class="form-control" placeholder="Enter Author Name" value="<?php echo htmlspecialchars($post->author); ?>">
        </div>

        <div class="form-group">
            <label>Tags: <small>(Optional)</small></label>
            <input name="tags" type="text" class="form-control" placeholder="Enter Tags" value="<?php echo htmlspecialchars($post->tags); ?>">
        </div>

        <div class="mb-4">
            <input name="submit" type="submit" class="btn btn-secondary" value="Submit">
            <a href="index.php" class="btn btn-secondary">Cancel</a>
            <input name="delete" type="submit" class="btn btn-danger" value="Delete">
        </div>   
    </form>
<?php else : ?>
	<p>No post found</p>
<?php endif; ?>	



<?php include 'includes/footer.php'; ?>



