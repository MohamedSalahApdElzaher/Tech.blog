<?php require_once "controllerUserData.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>contact Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
   <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="contact-form.php" method="POST" autocomplete="">
                    <h6 class="text-center">Email: tech.blog120@gmail.com</h6>
                    <p class="text-center">Phone: +02010103727.</p>
                    <?php
                    
                    if(count($msg) > 0){
                       
                        ?>
                        <div class="alert alert-success text-center">
                           
                             <?php
                            foreach($msg as $showmsg){
                                ?>
                                <li><?php echo $showmsg; ?></li>
                                <?php
                            }               
                     
                            ?>
                                             
                        </div>
                        <?php
                    }
                    ?>
                    
                    <div class="form-group">
                         <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email.." required>
                    </div>
                        <input class="form-control" type="text" name="subject" placeholder="Subject.." required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="message" placeholder="Message.." required>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="send" value="Send">
                    </div>
                     <div class="link login-link text-center">No changes? <a href="index.php">back home</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>