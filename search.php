
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php include "includes/nav.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row" >
            

            <!-- Blog Entries Column -->
            <div class="col-md-8"  style="border-style: groove;border-radius: 5px;">        
               
               <?php 
                
                         // search posts
                    if(isset($_POST['submit'])){
                       $search_text =  $_POST['search_text'];
                       $query = "SELECT * FROM posts WHERE p_content LIKE '%$search_text%'"; 
                       $result = mysqli_query($con, $query);                            
                    }
                     
                  ?>
                  
                     <p style="font-weight:bold; font-size:50px" class="page-header">
                       Results For <?php echo $search_text;?>
                     </p>
                  
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
                     <?php echo $p_title; ?> 
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
            
                    <!-- Blog Sidebar Widgets Column -->

                     <?php include "includes/sidebar.php"; ?>

        <!-- /.row -->

     

  <?php include "includes/footer.php"; ?>