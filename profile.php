<?php

require_once "controllerUserData.php";

if (!$_SESSION['login']) {
    header('location: login-user.php');
} else {
    $mail = $_SESSION['email'];
    $email_check = "SELECT user_name FROM users WHERE email = '$mail'";
    $res = mysqli_query($con, $email_check);
    while ($row = mysqli_fetch_assoc($res)) {
        $name = $row['user_name'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Edit Your Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="profile.php" method="POST" autocomplete="">
                    <h2 class="text-center">Your Profile</h2>
                    <p class="text-center">You can edit Name and Password.</p>
                    <?php
                    if (count($errors) == 1) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    } elseif (count($errors) > 1) {
                    ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach ($errors as $showerror) {
                            ?>
                                <li><?php echo $showerror; ?></li>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    } elseif (count($msg) > 0) {
                    ?>
                        <div class="alert alert-success text-center">

                            <?php
                            foreach ($msg as $showmsg) {
                            ?>
                                <li><?php echo $showmsg; ?></li>
                            <?php
                            }
                            ?>

                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required value="<?php echo $name ?>">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control button" type="submit" name="update" value="update">
                    </div>
                    <div class="link login-link text-center">No changes? <a href="index.php">back home</a></div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>