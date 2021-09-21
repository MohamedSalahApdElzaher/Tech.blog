   <?php

       if(isset($_POST['sumbit'])){
        
        $name = trim($_POST['name']);
        $message = trim($_POST['message']);
        $subject = trim($_POST['subject']);
        
        echo"ho";
        
        // send an message
        $to = 'ms01010103727@gmail.com'; 
        $res = mail($to, $subject, $message);
        echo $res;

        if ($res){

              $message = "Your Message was sent succssful";
              echo "<script type='text/javascript'>alert('$message');</script>";
              header("location: index.php"); 

         } else {

              $message = "Error Sending Message!!";
              echo "<script type='text/javascript'>alert('$message');</script>";
              header("location: contact-form.php"); 

        }
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

<h1 style="color:green;text-align: center;">Contact Form</h1>

<div>
  <form action="contact-form.php" method="post">
    <label for="name">Full Name</label>
    <input type="text" id="name" name="name" placeholder="Your name.." required>

    
    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Your Subjet.." required>
   
     <label for="message">Message</label>
     <input type="text" id="message" name="message" placeholder="Type your Message.." required>
     
    <input type="submit" value="Send" name="submit">
  </form>
</div>

</body>
</html>
