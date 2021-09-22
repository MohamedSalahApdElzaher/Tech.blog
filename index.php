
<?php include "includes/header.php"; ?>
    
<?php include "includes/nav.php"; ?>
   
 
    <!-- Page Content -->
    
    <div class="container">

        <div class="row">
            

            <!-- Get Blog details -->
            
            <div class="col-md-8">
              

               <?php 
                
                        $query = "SELECT * FROM posts";
                        $q_select = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($q_select)){
                            $p_title = $row['p_title'];
                            $p_author = $row['p_author'];
                            $p_date = $row['p_date'];
                            $p_image = $row['p_image'];
                            $p_content = $row['p_content'];

               ?>
                
           <!-- Blog Post -->
               
                <h2 style="font-weight:bold;" > <?php echo $p_title; ?> </h2>
                                 
                <p class="lead">
                     by <a href="https://github.com/MohamedSalahApdElzaher">
                     <?php echo $p_author;?></a>
                </p>
                
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $p_date; ?></p>
                
                <hr>              
               
                 <img class="img-responsive" src="images/<?php echo $p_image;?>"  alt="">
              
                <hr>
                
                <p><?php echo $p_content; ?></p>
                
          
                <hr> 
                 
              <?php } ?>       

                        
  
        </div>
                  
                   
 <!-- include sidebar -->

<?php include "includes/sidebar.php"; ?>

 <!-- include footer -->
        
<?php include "includes/footer.php"; ?>