                
                
                 <div class="col-md-4">
                 <!-- add new post -->
                 <div class="well">
                    <h4 style="font-weight:bold">Add Post</h4>
                    
                     <form action="controllerUserData.php" method="post" enctype="multipart/form-data">

                        <div class="input-group">
                          
                           <input type="text" name="text-title" placeholder="Title.." 
                            style="border-style: none;margin:5px;border-radius: 5px;" required>
                            
                            <textarea name="post-content" id="post" cols="40" rows="5" placeholder="What's in your mind..." 
                            style="margin:5px;border-radius: 5px;border-style: none;" required></textarea>
                        </div>
                        
                            <input type="file" name="choose-image" style="margin:5px">
                        
                           <button style="margin:5px" type="submit" name="add-post" class="btn btn-default"> <span  class="glyphicon glyphicon-plus"></span></button>
     
                     </form>
       
                </div>

                <!-- Blog Search Well -->
                <div class="well">
                    <h4 style="font-weight:bold">Search</h4>
                     <form action="search.php" method="post">

                    <div class="input-group">
                        <input name="search_text" type="text" class="form-control" required>
                        <span class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                         </span>
                       
                    </div>
                     </form>
                    <!-- /.input-group -->
                </div>
                
                 
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4 style="font-weight:bold">Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               
                        <?php // display navigation data
                    
                                $query = "SELECT * FROM categries";
                                $q_select = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($q_select)){
                                    $title=$row['title'];
                              ?>
                            
                          <li><a href='index.php?cat=<?php echo $title ?>'><?php echo $title ?></a></li> 
                            
                             <?php
                                    
                              }      
                                
                    
                            ?>
                               
                      
                            </ul>
                        </div>
       
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                
                
                <!-- Side Widget Well -->
                <div class="well">
                    <h4 style="font-weight:bold">About Us</h4>
                    <p>
                       
                       Join the conversation about all things creative and curious over at our blog! 
                        
                    </p>
                </div>

            </div>