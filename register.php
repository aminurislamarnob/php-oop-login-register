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
                    <h3>Register</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="container">
            <div class="row">
              <div class="column column-50">
                <form action="">
                    <fieldset>
                        <div>
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password">
                        </div>
                        <div>
                            <label for="c_password">Confirm Password</label>
                            <input type="text" id="c_password" name="c_password">
                        </div>
                        <div>
                            <label for="age">Age</label>
                            <input type="text" id="age" name="age">
                        </div>
                        <div>
                            <label for="location">Location</label>
                            <textarea id="location" name="location"></textarea>
                        </div>
                        <div>
                            <input class="button-primary" type="submit" value="Register">
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