<?php include 'includes/header.php'; ?>

<?php

    // check if login or not
    if(!isLoggedIn()){
        header("Location: login.php");
        exit();
    }

	// Create DB Object
	$postdb = new Post();

    // Get all categories
    $categories = $postdb->getAllCategories();


    // Process form
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
		$data =[
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
          
            if( $postdb->createPost($data) ){
                flash('post_message', 'Post Added');
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


<form method="post" action="add_post.php">
    <div class="form-group">
        <label>Post Title: <sup>*</sup></label>
        <input name="title" type="text" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
    </div>

    <div class="form-group">
        <label>Post Body: <sup>*</sup></label>
        <textarea name="body" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" 
            rows="5"><?php echo isset($_POST['body']) ? htmlspecialchars($_POST['body']) : ''; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
    </div>

    <div class="form-group">
        <label>Category: <sup>*</sup></label>
        <select name="category" class="form-control">
            <?php foreach($categories as $category) :  ?>
                <?php 
                    if( urlencode($category->id) == urlencode($_POST['category']) ){
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
        <input name="author" type="text" class="form-control <?php echo (!empty($data['author_err'])) ? 'is-invalid' : ''; ?>"  
            value="<?php echo isset($_POST['author']) ? htmlspecialchars($_POST['author']) : ''; ?>">
        <span class="invalid-feedback"><?php echo $data['author_err']; ?></span>
    </div>

    <div class="form-group">
        <label>Tags: <small>(Optional)</small></label>
        <input name="tags" type="text" class="form-control" 
            value="<?php echo isset($_POST['tags']) ? htmlspecialchars($_POST['tags']) : ''; ?>">
    </div>

    <div class="mb-4">
        <input name="submit" type="submit" class="btn btn-secondary" value="Submit">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
  
</form>

<?php include 'includes/footer.php'; ?>



