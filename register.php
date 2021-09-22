<?php 

include "includes/db.php";
error_reporting(E_ALL);

if(isset($_POST['submit'])){
    
     // add some client security validation inputs
    
    if( ctype_space($_POST['name']) || ctype_space($_POST['email']) || ctype_space($_POST['pass']))
    {
        $message = "Please Fill all data";
        echo "<script type='text/javascript'>alert('$message');</script>";  
        exit;
    }
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
    {
          $message = "Email is not a valid email address";
          echo "<script type='text/javascript'>alert('$message');</script>"; 
          exit;
    }
    
    $username = mysqli_real_escape_string($con, trim($_POST['name']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $pass =  mysqli_real_escape_string($con, trim($_POST['pass']));    
    $account = $_POST['account'];
    $gender = $_POST['gender'];
    
    // join time and date
    
    $unixTime = time();
    $timeZone = new \DateTimeZone('Africa/Cairo');

    $time = new \DateTime();
    $time->setTimestamp($unixTime)->setTimezone($timeZone);

    $formattedTime = $time->format('Y/m/d H:i:s');
     
    $query =  "INSERT INTO users (id, user_name, email, password, joined, gender, account_type) VALUES (null, '$username', '$email', '$pass', '$formattedTime', '$gender', '$account')";
    
    $result = mysqli_query($con, $query);    
    
    // display error message
    
    if(!$result){
        echo("Error description: " . mysqli_error($con));
        exit;
    }
    else{
        // sleep 3 sec
        sleep(3);
    
        // close connection
        //mysqli_free_result($result);
        mysqli_close($con);

        // redirect to page register.php
        
        header("location: login.php"); 
    }
       
}

?>



<!DOCTYPE html>

<html>
  <head>
    <title>Simple registration form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
   
   <link rel="stylesheet" href="css/form.css"> 
   
  </head>
  <body>
    <div class="main-block">
      <h1>Registration</h1>
      <form action="register.php" method="post">
        <hr>
        <div class="account-type">
          <input type="radio" value="Personal" id="radioOne" name="account" checked/>
          <label for="radioOne" class="radio">Personal</label>
          <input type="radio" value="Company" id="radioTwo" name="account" />
          <label for="radioTwo" class="radio">Company</label>
        </div>
        <hr>
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email" id="email" placeholder="Email" required/>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="name" id="name" placeholder="Name" required/>
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="pass" id="pass" placeholder="Password" required/>
        <hr>
        <div class="gender">
          <input type="radio" value="Male" id="male" name="gender" checked/>
          <label for="male" class="radio">Male</label>
          <input type="radio" value="Female" id="female" name="gender"  />
          <label for="female" class="radio">Female</label>
        </div>
        <hr>
        <div class="btn-block">
          <p>By clicking Register, you agree on our <a href="index.php">Privacy Policy</a>.</p>
          <input type="submit" id="submit" name="submit" value="Submit"/>
          <p>Aleady have an account?<a href="login.php">Login</a>.</p>
        </div>
      </form>
    </div>
  </body>
</html>