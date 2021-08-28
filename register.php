<?php include "includes/db.php";

// validate empty fields || Not submition
if((!isset($_POST['submit']) || empty($_POST['username']) || 
     empty($_POST['email']) || empty($_POST['age']) || empty($_POST['pass']))){
    $message = "Please Fill all data";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
else{
    
   // add some client security validation inputs
    $username = mysqli_real_escape_string($con, trim($_POST['username']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $pass =  mysqli_real_escape_string($con, trim($_POST['pass']));
    $age = mysqli_real_escape_string($con, trim($_POST['age']));
    
    $query =  "INSERT INTO users (id, user_name, email, age, password) VALUES 
    (null, '$username', '$email', '$age', '$pass')";
    $result = mysqli_query($con, $query);
    
    // display error message
    if(!$result){
        echo("Error description: " . mysqli_error($con));
        exit;
    }
    
    // free / close database connection
    mysqli_free_result($result);
    mysqli_close($con);
    
    // redirect to page register.php
    header("location: register.php"); 
}

?>


<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h3>Registration Form</h3>

<div>
  <form action="register.php" method="post">
    <label for="username">User Name</label>
    <input type="text" id="username" name="username" placeholder="Your name..">

    
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Your Email..">
   
     <label for="password">Password</label>
     <input type="text" id="pass" name="pass" placeholder="Your Password should appears here..">
    
     <label for="age">age</label>
     <input type="text" id="age" name="age" placeholder="Your Age..">
     
    <input type="submit" value="Submit" name="submit">
  </form>
</div>

</body>
</html>
