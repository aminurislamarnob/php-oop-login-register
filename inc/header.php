<!DOCTYPE html>
<?php
$currentFilePath = realpath( dirname(__FILE__) );
include_once( $currentFilePath . '/../lib/Session.php' );
Session::init();
Session::checkSession();

//logout 
if(isset($_GET['action']) && ($_GET['action']=='logout') ){
    Session::destroySession();
}
?>
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
                    <h2><a href="index.php"><img src="assets/images/php.png" alt="login register"> <span>Login <br>Register</span></a></h2>
                </div>
                <div class="column column-75">
                    <div class="main-menu">
                        <ul>
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>