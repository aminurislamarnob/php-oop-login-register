<?php
include('inc/header.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $userId = $_GET['id'];
}else{
    header("Location: index.php");
}

//user class object
include('lib/User.php');
$usersData = new User();

//form post
if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update']) ){
    $userEditResponse = $usersData->editUserById($userId, $_POST);
}

$requestedUser = $usersData->getUserById($userId);
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
              if(isset($userEditResponse)){
                    if(is_array($userEditResponse)){
                        echo '<ul class="error-response">';
                        foreach($userEditResponse as $error){
                            echo '<li>'.$error.'</li>';
                        }
                        echo '</ul>';
                    }else{
                        echo $userEditResponse;
                    }
                }
              ?>
                <form action="" method="POST">
                    <fieldset>
                        <div>
                            <label for="name">Full Name<span>*</span></label>
                            <input type="text" id="name" name="name" value="<?php echo $requestedUser['fullname'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['fullname'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="username">Username<span>*</span></label>
                            <input type="text" id="username" name="username" value="<?php echo $requestedUser['username'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['username'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="email">Email Address<span>*</span></label>
                            <input type="text" id="email" name="email" value="<?php echo $requestedUser['email'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['email'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="age">Age</label>
                            <input type="text" id="age" name="age" value="<?php echo $requestedUser['age'] ?? ''; ?>">
                        </div>
                        <div>
                            <input class="button-primary" type="submit" value="Update" name="update">
                        </div>
                    </fieldset>
                </form>
              </div>
            </div>
          </div>
    </div>
    <?php include('inc/footer.php'); ?>