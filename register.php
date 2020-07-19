<?php
include('lib/Authentication.php');
$auth = new Authentication();

if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['register']) ){
    $formSubmitResponse = $auth->userRegister($_POST);
    // var_dump($formSubmitResponse);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Login Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,400,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="column column-25">
                    <h2><a href="index.php">LOGIN/REG</a></h2>
                </div>
                <div class="column column-75">
                    <div class="main-menu">
                        <ul>
                            <li><a href="login.php">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
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
              if(isset($formSubmitResponse)){
                    if(is_array($formSubmitResponse)){
                        echo '<ul class="error-response">';
                        foreach($formSubmitResponse as $error){
                            echo '<li>'.$error.'</li>';
                        }
                        echo '</ul>';
                    }else{
                        echo $formSubmitResponse;
                    }
                }
              ?>
                <form action="" method="POST">
                    <fieldset>
                        <div>
                            <label for="name">Full Name<span>*</span></label>
                            <input type="text" id="name" name="name" value="<?php echo $_POST['name'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['fullname'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="username">Username<span>*</span></label>
                            <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['username'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="email">Email Address<span>*</span></label>
                            <input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['email'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="password">Password<span>*</span></label>
                            <input type="password" id="password" name="password" value="<?php echo $_POST['password'] ?? ''; ?>">
                            <div class="error-response"><?php echo $formSubmitResponse['password'] ?? ''; ?></div>
                        </div>
                        <div>
                            <label for="c_password">Confirm Password<span>*</span></label>
                            <input type="password" id="c_password" name="c_password" value="<?php echo $_POST['c_password'] ?? ''; ?>">
                            <div class="error-response">
                                <?php echo $formSubmitResponse['confirm_password'] ?? ''; ?>
                                <?php echo $formSubmitResponse['password_match'] ?? ''; ?>
                            </div>
                        </div>
                        <div>
                            <label for="age">Age</label>
                            <input type="text" id="age" name="age" value="<?php echo $_POST['age'] ?? ''; ?>">
                        </div>
                        <div>
                            <label for="city">City</label>
                            <select id="city" name="city">
                                <option value="">--Select City--</option>
                                <option value="dhaka">Dhaka</option>
                                <option value="bogura">Bogura</option>
                                <option value="rangpur">Rangpur</option>
                                <option value="dinajpur">Dinajpur</option>
                                <option value="rajshahi">Rajshahi</option>
                            </select>
                        </div>
                        <div>
                            <input class="button-primary" type="submit" value="Register" name="register">
                        </div>
                    </fieldset>
                </form>
              </div>
            </div>
          </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="column">
                    <p>Copyright &copy;2020 by <a href="http://aminurislam.me/">aminurislam.me</a>. All right reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>