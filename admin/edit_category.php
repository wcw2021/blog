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

    // Get single category
    $category = $postdb->getCategory($id);

?>

<?php

    // Update Category
	if(isset($_POST['submit'])){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
		$data =[
            'id' => $id,
            'name' => trim($_POST['name']),
            'name_err' => ''
        ];

        // Validate data
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter category name';
        }


        // Make sure no errors
        if( empty($data['name_err']) ) {
            // var_dump($data);
          
            if( $postdb->updateCategory($data) ){
                flash('category_message', 'Category Updated');
                header("Location: index.php");
                exit();
            } else {
                die('Something went wrong');
            }
        }

	}else {

        // Init data
        $data = [
            'name_err' => '',
        ];
    }

?>

<?php

    // Delete Category
	if(isset($_POST['delete'])){

        if( $postdb->deleteCategory($id) ){
            flash('category_message', 'Category Deleted');
            header("Location: index.php");
            exit();
        } else {
            die('Something went wrong');
        }

	}

?>


<?php if($category) : ?>
    <form method="post" action="edit_category.php?id=<?php echo urlencode($id) ?>">
    <div class="form-group">
        <label>Category Name: <sup>*</sup></label>
        <input name="name" type="text" class="form-control" placeholder="Enter Category" value="<?php echo htmlspecialchars($category->name); ?>">
    </div>

    <div class="mb-4">
        <input name="submit" type="submit" class="btn btn-secondary" value="Submit">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        <input name="delete" type="submit" class="btn btn-danger" value="Delete">
    </div>
    </form>
<?php else : ?>
	<p>No category found</p>
<?php endif; ?>	

<?php include 'includes/footer.php'; ?>



