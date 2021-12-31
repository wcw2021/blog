
<?php include 'includes/header.php'; ?>

<?php

    // check if login or not
    if(isLoggedIn()){
        header("Location: index.php");
        exit();
    }

	// Create DB Object
	$userdb = new User();

    // Process form
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
		$data =[
          'name' => trim($_POST['name']),
          'password' => trim($_POST['password']),
          'name_err' => '',
          'password_err' => '', 
        ];

        // Validate Username
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter username';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Make sure errors are empty
        if(empty($data['name_err']) && empty($data['password_err'])){

            // Check and set logged in user
            $loggedInUser = $userdb->login($data['name'], $data['password']);

            if($loggedInUser){
                session_regenerate_id();
                $_SESSION['user_id'] = $loggedInUser->id;
                $_SESSION['user_name'] = $loggedInUser->name;
                header("Location: index.php");
                exit();
            } else {
                flash('user_message', 'No User Found', 'alert alert-danger');
            }
        }


	}else {

        // Init data
        $data = [
            'name' => '',
            'password' => '', 
            'name_err' => '',
            'password_err' => ''
        ];
    }

?>


<div class="row mb-5">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?> 
            <h2 class="mb-4">Login</h2>
            <?php flash('user_message'); ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="user">Username: <sup>*</sup></label>
                    <input type="user" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <input type="submit" value="Login" class="btn btn-secondary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-6 mx-auto text-center">
        <small class="">Hint: default username is 'admin' with password 'password' </small>
    </div>
</div>

<?php include 'includes/footer.php'; ?>







