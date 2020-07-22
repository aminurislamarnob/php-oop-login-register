<?php
include('inc/header.php');

//include User class
include('lib/User.php');
$usersData = new User();
?>
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
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Location</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users = $usersData->getAllUsers();
                    $i = 0;
                    foreach ($users as $user) {
                        $i++;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['age']; ?></td>
                        <td><?php echo ucfirst($user['city']); ?></td>
                        <td>
                        <?php
                        $currentUserId = Session::getSession('userID');
                        if($currentUserId === $user['id']){
                            echo '<a class="button button-small" href="my-profile.php?id='.$user['id'].'">My Profile</a>';
                        }else{
                            echo '<a class="button button-small" href="edit-user.php?id='.$user['id'].'">Edit</a>'; 
                        }
                        ?>
                            <a href="?action=delete&id=<?php echo $user['id']; ?>" class="button button-outline button-small">Delete</a>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
    </div>
<?php include('inc/footer.php'); ?>