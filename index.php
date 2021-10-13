<?php

include "includes/header.php";
include "includes/nav.php";
include "model/post.php";
include "model/user.php";
include "model/pagination.php";

// if user dosn't sign in

if (!$_SESSION['login']) {
    header('location: login-user.php');
}

?>


<!-- add new post -->

<form action="controllerUserData.php" method="post" enctype="multipart/form-data">

    <input style="margin-bottom:5px;margin-left:15px;" type="text" name="text-title" placeholder="Title.." required><br>

    <textarea placeholder="What's in your mind..." name="post-content" id="post" cols="5" rows="5" style="width:80%;margin-bottom:15px;margin-left:15px;margin-top:5px;border-style: groove;border-radius: 5px;" required></textarea><br>

    <input type="file" name="choose-image" style="margin-bottom:15px;margin-left:15px;">


    <button style="margin-bottom:15px;margin-left:15px;" type="submit" name="add-post" class="btn   btn-default">
        <span class="glyphicon glyphicon-send"></span>
    </button>

    <hr>
</form>


<!-- Page Content -->

<div class="container">

    <div class="row">

        <!-- Get Blog details -->

        <div class="col-md-8" style="border-style: groove;border-radius: 5px;">

            <?php

            // get user email stored in session

            $user_email = $_SESSION['email'];

            // connect User class to database

            User::setDatabase($con);

            // call get_by_email method

            $users = User::get_by_email($user_email);

            foreach ($users as $user) {
                $user_id = $user->getId();
            }

            Post::setDataBase($con);

            // if want to add pagination, use below code
            /*
            $page = $_GET['page'] ?? 1;
            $pre_page = 5; // show only 5 posts every page if using pagination
            $total = Post::countAllPosts();
            $pagination = new Pagination($page, $pre_page, $total);

            $sql = "SELECT * FROM posts LIMIT {$pre_page} OFFSET {$pagination->offest()}";
            $posts = Post::get_post_by_sql($sql);

            */

            // get array of objects (posts records)

            $posts = Post::getAllPosts();


            foreach ($posts as $post) {
                $id = $post->getId();
                $p_id = $post->getAuthor_id();
                $p_title = $post->getTitle();
                $p_author = $post->getAuthor();
                $p_date = $post->getDate();
                $p_image = $post->getImage();
                $p_content = $post->getContent();
                $likes = $post->getL_count();
                $comments = $post->getLC_count();

                // 
            ?>

                <!-- Blog Post -->

                <h3 style="font-weight:bold;"><a style="color:black;" href="post-page.php?id=<?php echo $id ?>"><?php echo $p_title; ?></a></h3>

                <?php

                // show edit/remove buttons if this user has this post

                if ($p_id === $user_id) {

                ?>

                    <a style="float:right;margin:5px;font-weight:bold;" href="delete.php?id=<?php echo $id ?>">Delete</a>
                    <a style="float:right;margin:5px;font-weight:bold;" href="edit_post.php?id=<?php echo $id ?>">Edit</a>


                <?php } ?>

                <p><span class="glyphicon glyphicon-user"></span>
                    <a href="author_posts.php?id=<?php echo $p_id ?>"><?php echo $p_author; ?></a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span> <?php echo $p_date; ?></p>


                <p><?php echo $p_content; ?></p>

                <h6 name="comments-count" style="float:right;color:black;font-weight:bold;"><?php echo $comments ?></h6>

                <span name="comment" style="float:right;margin-bottom:10px;margin-top:10px;margin-left:10px;font-weight:bold;margin-right:5px;" class="glyphicon glyphicon-comment"></span>

                <img class="img-responsive" src="images/<?php echo $p_image; ?>" alt="">

                <hr>
                <hr>

            <?php } ?>

        </div>



        <!-- include sidebar -->

        <?php include "includes/sidebar.php"; ?>

        <!-- include footer -->

        <?php

        /*    including pagination code
        
                    if($pagination->total_pages() > 1){
                        echo "<div class=\"pagination\">";
                        $url = url_for('index.php');
                        $pagination->prev_link($url);
                        $pagination->next_link($url);

                        echo "</div>";
                    }
                    */

        ?>

        <?php include "includes/footer.php"; ?>