    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HOME</a>
            </div>
          
            
                <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                <ul class="nav navbar-nav">
                     
                    <li><a href="contact-form.php">Contact US</a></li>
                    
                </ul>
                
                 <ul class="nav navbar-nav" style="float:right">
                     
                   <li><a href="" style="color:white"><?php echo $_SESSION['email']?></a></li>
                   <li><a href="logout-user.php">Logout</a></li>;                   
                    <li><a href="profile.php">Profile</a></li>
                </ul>
                
                
                
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>