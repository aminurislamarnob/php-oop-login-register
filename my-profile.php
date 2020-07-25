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
$requestedUser = $usersData->getUserById($userId);
?>
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h3>My Profile</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="container">
            <div class="row">
              <div class="column column-50">
                <ul>
                    <li><strong>Name: </strong><?php echo $requestedUser['fullname'] ?? ''; ?></li>
                    <li><strong>Username: </strong><?php echo $requestedUser['username'] ?? ''; ?></li>
                    <li><strong>Email: </strong><?php echo $requestedUser['email'] ?? ''; ?></li>
                    <li><strong>Age: </strong><?php echo $requestedUser['age'] ?? ''; ?></li>
                    <li><strong>City: </strong><?php echo $requestedUser['city'] ?? ''; ?></li>
                </ul>
                <a href="edit-profile.php?id=<?php echo $requestedUser['id'] ?? ''; ?>" class="button button-primary">Edit Profile</a>
                <a href="change-password.php?id=<?php echo $requestedUser['id'] ?? ''; ?>" class="button">Change Password</a>
              </div>
            </div>
          </div>
    </div>
    <?php include('inc/footer.php'); ?>