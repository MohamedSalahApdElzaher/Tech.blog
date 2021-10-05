<?php   include "includes/db.php";


session_start();

$email = "";
$name = "";
$errors = array();
$msg = array();

//if user signup button

if(isset($_POST['signup'])){
    // add client secure
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    // check password matching
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    // check existance of Emails
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    
    if(count($errors) === 0){
        
        // secure password using hashing method
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        
        $query = "INSERT INTO users (id,user_name, email, password)
                        values(null,'$name', '$email', '$encpass')";
        $data_check = mysqli_query($con, $query);
           

        if($data_check){
            $msg['signed'] ='Your account just created successfully.';
            
            /*
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
            
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
     
    }

}

// if user click update profile

if(isset($_POST['update'])){
    // add client secure
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = $_SESSION['email'];
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    if(count($errors) === 0){
        
        // secure password using hashing method
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "UPDATE users SET user_name='$name', password='$encpass' WHERE email = '$email'";
        
        $data_check = mysqli_query($con, $query);
           
        if($data_check){
            $msg['signed'] ='Your account just updated successfully.';

        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
     
    }

}

// Datetime function

function get_date_time(){
    $unixTime = time();
    $timeZone = new \DateTimeZone('Africa/Cairo');

    $time = new \DateTime();
    $time->setTimestamp($unixTime)->setTimezone($timeZone);

    $formattedTime = $time->format('Y/m/d H:i:s');
    return $formattedTime;
}

// get user info

function get_author_info(){
        include "includes/db.php";
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
              $author_info['name'] = $row['user_name'];
              $author_info['id'] = $row['id'];
        }
       return $author_info;
}

// add post to database

function add_post_db($author, $author_id, $title, $content, $date, $img_name){
    include "includes/db.php";
    $query = "INSERT INTO posts (p_id, author_id, p_author, p_title, p_content, p_date, p_image) VALUES (null,'$author_id','$author', '$title', '$content', '$date', '$img_name')";
    $res = mysqli_query($con, $query);  
    if(!$res) echo mysqli_error($con);
    else header('location: index.php'); 
}

// if user click add post

if(isset($_POST['add-post'])){	
    include "includes/db.php";
    // upload image
	$img_name = $_FILES['choose-image']['name'];
	$tmp_img_name = $_FILES['choose-image']['tmp_name'];
    $folder = 'images/';
	$res = move_uploaded_file($tmp_img_name, $folder.$img_name);
    
    $title = $_POST['text-title'];
    $content = $_POST['post-content'];
    $date = get_date_time();
    $author_info = get_author_info();
    $author = $author_info['name'];
    $author_id = $author_info['id'];
    add_post_db($author, $author_id, $title, $content, $date, $img_name);
}

// if user click edit post

if(isset($_POST['edit-post'])){	
    include "includes/db.php";
    // upload image
	$img_name = $_FILES['edit-choose-image']['name'];
	$tmp_img_name = $_FILES['edit-choose-image']['tmp_name'];
    $folder = 'images/';
	$res = move_uploaded_file($tmp_img_name, $folder.$img_name);
    
    $id = $_SESSION['edit_post_id'];
    
    $title = $_POST['edit-text-title'];
    $content = $_POST['edit-post-content'];
    
    $query = "UPDATE posts SET p_title='$title', p_content='$content', p_image='$img_name' WHERE p_id='$id'";
    mysqli_query($con, $query);
    header('location: index.php'); 
}

// if user click send message

if(isset($_POST['send'])){
    $msg['msg1'] = 'Your Message just sent successfully';
    $msg['msg2'] = 'Thanks for your feedback';
}

    //if user click verification code submit button

    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['user_name'] = $name;
                $_SESSION['email'] = $email;
                header('location: index.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

   // if user click like button
   
    if(isset($_POST['like'])){
        
    }

   // if user click like button
   
    if(isset($_POST['like'])){
        
    }

  // if user click comment

    if(isset($_POST['submit-comment'])){
        //include "includes/db.php";
        $id = $_SESSION['p_id'] ;
        $author_info = get_author_info();
        $author = $author_info['name'];
        $date = get_date_time();
        $comment = $_POST['comment_text'];
        //TODO ADD COMMENT TO posts database
        $q = "SELECT * FROM posts WHERE p_id='$id'";
        $res = mysqli_query($con, $q);
        while($row = mysqli_fetch_assoc($res)){
            $comment_count = $row['c_count'];
        }
        $comment_count++;
        $query = "UPDATE posts SET c_count='$comment_count' WHERE p_id='$id'";
        $q = "INSERT INTO comments (post_id, c_author, c_date , comment) VALUES ('$id', '$author', '$date', '$comment')";
        mysqli_query($con, $q);
        mysqli_query($con, $query);
        header('location: index.php');
    }
    

    //if user click login button

    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
      
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];

            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                
                $_SESSION['login'] = true;
                $msg['logged']='You are just logged in successfully.';
 
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
                
            }else{
                $errors['email'] = "Incorrect email or password!";
                $_SESSION['login'] = false;
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
            $_SESSION['login'] = false;
        }
    }

    //if user click continue button in forgot password form

    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: tech.blog123@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button

    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button

    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click

    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }

?>