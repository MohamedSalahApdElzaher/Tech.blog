<?php

include "includes/db.php";
include "model/post.php";
include "model/user.php";

// start USER connection 
$connection = User::setDatabase($con);
// create new obj
$user = new User();

// start POST connection to db
Post::setDataBase($con);
// create new obj
$post = new Post;


session_start();

$errors = array(); // handel errors messages
$msg = array(); // handel successfull messages

// hint: START DEALING WITH USER CLASS

//if user signup button

if (isset($_POST['signup'])) {

    // set class properties / sanitize fields
    $user->setUser_name($connection->real_escape_string($_POST['name']));
    $user->setEmail($connection->real_escape_string($_POST['email']));
    $user->setDate(get_date_time());

    $password = $connection->real_escape_string($_POST['password']);
    $cpassword = $connection->real_escape_string($_POST['cpassword']);

    // check password matching
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }

    // check existance of Emails
    $result = User::get_by_email($user->getEmail());

    if (count($result) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    } elseif (count($errors) === 0) {

        // secure password using hashing method
        $encpass = password_hash($password, PASSWORD_BCRYPT);

        $user->setPass($encpass);

        $data_check = $user->create();

        if ($data_check) {
            $msg['signed'] = 'Your account just created successfully.';

            /*  // TODO: sending validation code but not working :(
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: ms01010103727@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
            */
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}

// if user click update profile

if (isset($_POST['update'])) {
    // add client secure
    $user->setUser_name($connection->real_escape_string($_POST['name']));
    $email = $_SESSION['email'];
    $password = $connection->real_escape_string($_POST['password']);

    if (count($errors) === 0) {

        // secure password using hashing method
        $encpass = password_hash($password, PASSWORD_BCRYPT);

        $user->setPass($encpass);

        $data_check = $user->update($email);

        if ($data_check) {
            $msg['signed'] = 'Your account just updated successfully.';
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}

// Datetime function

function get_date_time()
{
    $unixTime = time();
    $timeZone = new \DateTimeZone('Africa/Cairo');

    $time = new \DateTime();
    $time->setTimestamp($unixTime)->setTimezone($timeZone);

    $formattedTime = $time->format('Y/m/d H:i:s');
    return $formattedTime;
}

// get user info

function get_author_info()
{
    $author_info = [];
    $email = $_SESSION['email'];
    $users = User::get_by_email($email);
    foreach ($users as $user) {
        $author_info['id'] = $user->getId();
        $author_info['name'] = $user->getUserName();
    }
    return $author_info;
}

// hint: START DEALING WITH POST CLASS

// upload image
function uploadImage()
{
    // upload image
    $img_name = $_FILES['choose-image']['name'];
    $tmp_img_name = $_FILES['choose-image']['tmp_name'];
    $folder = 'images/';
    $res = move_uploaded_file($tmp_img_name, $folder . $img_name);
    if ($res) return $img_name;
}

// if user click add post

if (isset($_POST['add-post'])) {

    $post->setTitle($_POST['text-title']);
    $post->setContent($_POST['post-content']);
    $post->setDate(get_date_time());
    $post->setImage(uploadImage());

    $author_info = get_author_info();
    $post->setAuthor($author_info['name']);
    $post->setAuthorId($author_info['id']);

    $post->Create();
    header('location: index.php');
}

// if user click edit post

if (isset($_POST['edit-post'])) {
    // upload image
    $img_name = $_FILES['edit-choose-image']['name'];
    $tmp_img_name = $_FILES['edit-choose-image']['tmp_name'];
    $folder = 'images/';
    move_uploaded_file($tmp_img_name, $folder . $img_name);

    $id = $_SESSION['edit_post_id'];
    $post->setTitle($_POST['edit-text-title']);
    $post->setContent($_POST['edit-post-content']);
    $post->setImage($img_name);

    $post->Update($id);
    header('location: index.php');
}



// if user click send message

if (isset($_POST['send'])) {
    $msg['msg1'] = 'Your Message just sent successfully';
    $msg['msg2'] = 'Thanks for your feedback';
}

//if user click verification code submit button  TODO: FIX ERROR :( 

if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['user_name'] = $name;
            $_SESSION['email'] = $email;
            header('location: index.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// if user click like button

if (isset($_POST['like'])) {
}

// if user click comment

if (isset($_POST['submit-comment'])) {
    //include "includes/db.php";
    $id = $_SESSION['p_id'];
    $author_info = get_author_info();
    $author = $author_info['name'];
    $date = get_date_time();
    $comment = $_POST['comment_text'];
    //TODO ADD COMMENT TO posts database
    $q = "SELECT * FROM posts WHERE p_id='$id'";
    $res = mysqli_query($con, $q);
    while ($row = mysqli_fetch_assoc($res)) {
        $comment_count = $row['c_count'];
    }
    $comment_count++;
    $query = "UPDATE posts SET c_count='$comment_count' WHERE p_id='$id'";
    $q = "INSERT INTO comments (post_id, c_author, c_date , comment) VALUES ('$id', '$author', '$date', '$comment')";
    mysqli_query($con, $q);
    mysqli_query($con, $query);
    $_SESSION['id'] = $id;
    header('location: post-page.php');
}


//if user click login button

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];

        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;

            $_SESSION['login'] = true;
            $msg['logged'] = 'You are just logged in successfully.';

            /*
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                  header('location: index.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
             */
        } else {
            $errors['email'] = "Incorrect email or password!";
            $_SESSION['login'] = false;
        }
    } else {
        $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        $_SESSION['login'] = false;
    }
}

//if user click continue button in forgot password form

if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: tech.blog123@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

//if user click check reset otp button

if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

//if login now button click

if (isset($_POST['login-now'])) {
    header('Location: login-user.php');
}
