<?php include "includes/db.php";

if(!isset($_POST['submit'])){
    //echo "Please Fill all data";
}
else{
    
    $message = "Successful Completion";
    echo "<script type='text/javascript'>alert('$message');</script>";
    
    /*
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $age = $_POST['age'];
    $query = "INSERT INTO users (id, user_name, email, age, password) VALUES 
    (null, '$username', '$email', '$age', '$pass')";
    $result = mysqli_query($con, $query);
    
    if(!$result){
        echo("Error description: " . mysqli_error($con));
        exit;
    }
    
    // close database connection
    //mysqli_free_result($result);
    mysqli_close($con);
   // header("location: profile.php");
   
   */
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
