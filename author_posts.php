<?php 

include "includes/header.php";
include "model/post.php";

?>

<!-- Navigation -->

<?php include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">


        <!-- Blog Entries Column -->
        <div class="col-md-8" style="border-style: groove;border-radius: 5px;">

            <?php

            $id = $_GET['id'];
            Post::setDataBase($con);
            $query = "SELECT * FROM posts WHERE author_id='$id'";
            $posts = Post::get_post_by_sql($query);
            foreach($posts as $post){
                $p_title = $post->getTitle();
                $p_author = $post->getAuthor();
                $p_date = $post->getDate();
                $p_image = $post->getImage();
                $p_content = $post->getContent();        
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

                <img class="img-responsive" src="images/<?php echo $p_image; ?>" alt="">
                <hr>

            <?php } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"; ?>

        <!-- /.row -->