<?php
include('inc/header.php');

if( isset($_GET['id']) && !empty($_GET['id']) && (Session::getSession('userID') == $_GET['id']) ){
    $userId = $_GET['id'];
}else{
    header("Location: index.php");
}

//user class object
include('lib/User.php');
$usersData = new User();

//form post
if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['change_password']) ){
    $passwordChangeResponse = $usersData->changePasswordById($userId, $_POST);
}
?>
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h3>Register</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="container">
            <div class="row">
              <div class="column column-50">
              <?php
              if(isset($passwordChangeResponse)){
                    if(is_array($passwordChangeResponse)){
                        echo '<ul class="error-response">';
                        foreach($passwordChangeResponse as $error){
                            echo '<li>'.str_replace('_', ' ', $error).'</li>';
                        }
                        echo '</ul>';
                    }else{
                        echo $passwordChangeResponse;
                    }
                }
              ?>
                <form action="" method="POST">
                    <fieldset>
                        <div>
                            <label for="old_password">Old Password<span>*</span></label>
                            <input type="password" id="old_password" name="old_password" value="<?php echo $_POST['old_password'] ?? ''; ?>">
                            <div class="error-response"><?php echo $passwordChangeResponse['old_password'] ?? ''; ?></div>
                            <div class="error-response"><?php echo $passwordChangeResponse['password_match_old'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="new_password">New Password<span>*</span></label>
                            <input type="password" id="new_password" name="new_password" value="<?php echo $_POST['new_password'] ?? ''; ?>">
                            <div class="error-response"><?php echo $passwordChangeResponse['new_password'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="c_password">Confirm Password<span>*</span></label>
                            <input type="password" id="c_password" name="c_password" value="<?php echo $_POST['c_password'] ?? ''; ?>">
                            <div class="error-response"><?php echo $passwordChangeResponse['c_password'] ?? ''; ?></div>
                        </div>
                        <div>
                            <input class="button-primary" type="submit" value="Change Password" name="change_password">
                        </div>
                    </fieldset>
                </form>
              </div>
            </div>
          </div>
    </div>
    <?php include('inc/footer.php'); ?>