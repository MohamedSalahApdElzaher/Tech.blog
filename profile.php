<?php 

    session_start();
    include "includes/db.php";

    // check for user status

    if($_SESSION['logged'] == false){
        header('location: login.php');
        exit;
    }

    // update values
    
    if(isset($_POST['submit'])){
        $id = $_SESSION['id'];
        $name = $_POST['name'];
        $account = $_POST['account'];
        $gender = $_POST['gender'];
        $pass = $_POST['pass'];
       
        $query = "UPDATE users SET user_name='$name', password='$pass' , account_type='$account',
        gender='$gender' WHERE id='$id'";
        
        $result = mysqli_query($con, $query);
        
       if(!$result){
            echo("Error description: " . mysqli_error($con));
            exit;
        }
        else{
            
            // update sessions values
            
            $_SESSION['account_type'] = $account;
            $_SESSION['name']=$name;
            $_SESSION['gender']=$gender;
            $_SESSION['password']=$pass;
            
            // sleep 3 sec
            sleep(3);

            // close connection
            mysqli_close($con);

            // redirect to page register.php

            header("location: profile.php"); 
        }
    }

?>



<!DOCTYPE html>

<html>
  <head>
    <title>Edit Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/form.css"> 

  </head>
  <body>
    <div class="main-block">
      <h1>Edit Profile</h1>
      <form action="profile.php" method="post">
        <hr>
        <div class="account-type">
          <input type="radio" value="Personal" id="radioOne" name="account" <?php echo ($_SESSION['account_type']=='Personal')?'checked':''; ?> />
          <label for="radioOne" class="radio">Personal</label>
          <input type="radio" value="Company" id="radioTwo" name="account" <?php echo ($_SESSION['account_type']=='Company')?'checked':'' ;?> />
          <label for="radioTwo" class="radio">Company</label>
        </div>
        <hr>
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email" value="<?php echo $_SESSION['email']. " (Unique)"; ?>" id="email" placeholder="Email" required/>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="name" value="<?php echo $_SESSION['name'] ; ?>" id="name" placeholder="Name" required/>
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="pass" value="<?php echo  $_SESSION['password']; ?>" id="pass" placeholder="Password" required/>
        
        <label id="icon" for="name"><i class="fas fa-allergies"></i></label>
        <input type="text" name="id" value="<?php echo $_SESSION['id']. " (Unique)" ; ?>" id="name" placeholder="Name" required/>
        
         <label id="icon" for="name"><i class="fas fa-calendar-alt"></i></label>
        <input type="text" name="id" value="<?php echo $_SESSION['joined']. " (Joined)" ; ?>" id="name" placeholder="Name" required/>
        
        <hr>
        <div class="gender">
        
            <input type="radio" id="male" name="gender" value="Male"
             <?php echo ($_SESSION['gender']=='Male')?'checked':'' ;?> />

          
          <label for="male" class="radio">Male</label>
          
          <input type="radio" id="female" name="gender" value="Female" <?php echo ($_SESSION['gender']=='Female')?'checked':''; ?> />

          <label for="female" class="radio">Female</label>
          
        </div>
        <hr>
        <div class="btn-block">
          <input type="submit" id="submit" name="submit" value="Update"/>
        </div>
      </form>
    </div>
  </body>
</html>