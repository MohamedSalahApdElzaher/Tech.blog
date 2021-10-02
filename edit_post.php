
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php include "includes/nav.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row" >
            

            <!-- Blog Entries Column -->
            <div class="col-md-8"  style="border-style: groove;border-radius: 5px;">        
               
               <?php 
                
                       $id = $_GET['id'];
                       $_SESSION['edit_post_id']=$id;
                       $query = "SELECT * FROM posts WHERE p_id='$id'"; 
                       $result = mysqli_query($con, $query);                            
         
                  ?>
                  
        
                  
                <?php            
                        while($row = mysqli_fetch_assoc($result)){
                            $p_title = $row['p_title'];
                            $p_author = $row['p_author'];
                            $p_date = $row['p_date'];
                            $p_image = $row['p_image'];
                            $p_content = $row['p_content'];

               ?>
                       

                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $p_title; ?> </a>
                </h2>
                
                <p class="lead">
                    by <a href="index.php"><?php echo $p_author; ?></a>
                </p>
                
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $p_date; ?></p>
                
                <hr>
                
                <p><?php echo $p_content; ?></p>
      
                <hr> 
                
               <img class="img-responsive" src="images/<?php echo $p_image;?>"  alt="">
                <hr>
                 
                     <?php } ?>
                
  
        </div>
            
 <!-- include sidebar -->

<?php include "includes/edit-sidebar.php"; ?>

     