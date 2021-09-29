<?php include "includes/header.php"; ?>
    
<?php 



include "includes/nav.php";

// if user dosn't sign in

if(!$_SESSION['login']){
     header('location: login-user.php');
}

?>

 
    <!-- Page Content -->
    
    <div class="container">

        <div class="row">
            
            <!-- Get Blog details -->
            
            <div class="col-md-8" style="border-style: groove;border-radius: 5px;">
             
               <?php 
                
                  $user_email = $_SESSION['email'];
                  $q = "SELECT * FROM users WHERE email='$user_email'";
                  $q_sel = mysqli_query($con, $q);
                  while($row = mysqli_fetch_assoc($q_sel)){
                      $user_id = $row['id'];
                  }
                
                        $query = "SELECT * FROM posts";
                        $q_select = mysqli_query($con, $query);
                
                        while($row = mysqli_fetch_assoc($q_select)){
                            $p_id = $row['author_id'];
                            $p_title = $row['p_title'];
                            $p_author = $row['p_author'];
                            $p_date = $row['p_date'];
                            $p_image = $row['p_image'];
                            $p_content = $row['p_content'];

               ?>
                
           <!-- Blog Post -->
               
                <h3 style="font-weight:bold"> <?php echo $p_title; ?> </h3>
                
                <?php 
                
                    if($p_id === $user_id){
                
                ?>
                
                <button style="float:right" type="submit" name="edit-post" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button> 
                 
                <button style="float:right" type="submit" name="remove-post" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> </button>
             
               <?php } ?>
               
                <p><span class="glyphicon glyphicon-user"></span>
                <a href=""><?php echo $p_author;?></a></p>
                
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $p_date; ?></p>
                
                 <p><?php echo $p_content; ?></p>
                               
                 <img class="img-responsive" src="images/<?php echo $p_image;?>"  alt="">

                <hr><hr>
                 
                <?php } ?>                              
  
        </div>
    
                  
                   
 <!-- include sidebar -->

<?php include "includes/sidebar.php"; ?>

 <!-- include footer -->
        
<?php include "includes/footer.php"; ?>