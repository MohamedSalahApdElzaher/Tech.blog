   
                 <div class="col-md-4">
                 <!-- add new post -->
                 <div class="well">
                    <h4 style="font-weight:bold">Edit This Post</h4>
                    
                     <form action="controllerUserData.php" method="post" enctype="multipart/form-data">

                        <div class="input-group">
                          
                           <input type="text" name="edit-text-title" placeholder="Change Title.." 
                            style="border-style: none;margin:5px;border-radius: 5px;" required>
                            
                            <textarea name="edit-post-content" id="post" cols="40" rows="5" placeholder="Change Content.." 
                            style="margin:5px;border-radius: 5px;border-style: none;" required></textarea>
                        </div>
                        
                            <input type="file" name="edit-choose-image" style="margin:5px">
                        
                           <button style="margin:5px" type="submit" name="edit-post" class="btn btn-default"> <span  class="glyphicon glyphicon-plus"></span></button>
     
                     </form>
       
                </div>
  
            </div>