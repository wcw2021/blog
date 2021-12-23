<?php include 'includes/header.php'; ?>

<?php

    // check if login or not
    if(!isLoggedIn()){
        header("Location: login.php");
        exit();
    }
    
	// Create DB Object
	$postdb = new Post();

    // Process form
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
		$data =[
          'name' => trim($_POST['name']),
          'name_err' => ''
        ];

        // Validate data
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter category name';
        }


        // Make sure no errors
        if( empty($data['name_err']) ) {
          
            if( $postdb->createCategory($data) ){
                flash('category_message', 'Category Added');
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


<form method="post" action="add_category.php">
    <div class="form-group">
        <label>Category Name: <sup>*</sup></label>
        <input name="name" type="text" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
    </div>

    <div class="mb-4">
        <input name="submit" type="submit" class="btn btn-secondary" value="Submit">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php include 'includes/footer.php'; ?>







