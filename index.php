<?php
include('lib/Session.php');
Session::init();
Session::checkSession();

//logout 
if(isset($_GET['action']) && ($_GET['action']=='logout') ){
    Session::destroySession();
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
                    <h2><a href="index.html">LOGIN/REG</a></h2>
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
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h3>My Account</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="container">
            <div class="row">
              <div class="column">
              <?php
              //print loggedin success message
              echo Session::getSession('login_message') ?? '';
              Session::unsetSessionKey('login_message');
              ?>
                <table>
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>Stephen Curry</td>
                        <td>27</td>
                        <td>aminur@gmail.com</td>
                        <td>Akron, OH</td>
                        <td>
                            <a class="button button-small" href="update-user.html">Edit</a>
                            <a class="button button-outline button-small">Delete</a>
                        </td>
                      </tr>
                      <tr>
                        <td>02</td>
                        <td>Klay Thompson</td>
                        <td>25</td>
                        <td>islam@gmail.com</td>
                        <td>Los Angeles, CA</td>
                        <td>
                            <a class="button" href="update-user.html">Edit</a>
                            <a class="button button-outline">Delete</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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