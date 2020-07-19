<?php
include_once('lib/Authentication.php');
include_once('lib/Session.php');
$auth = new Authentication();

//check already loggedin
Session::init();
$auth->checkLoggedin();

if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['login']) ){
    $formSubmitResponse = $auth->userLogin($_POST);
    //var_dump($formSubmitResponse);
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
            </div>
        </div>
    </header>
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h3>Login</h3>
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
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" value="<?php echo $_POST['password'] ?? ''; ?>">
                        </div>
                        <div>
                            <input class="button-primary" type="submit" name="login" value="Login">
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