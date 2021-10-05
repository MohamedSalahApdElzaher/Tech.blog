<?php include "includes/header.php"; ?>

<?php


include "includes/nav.php";

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

            $user_email = $_SESSION['email'];
            $q = "SELECT * FROM users WHERE email='$user_email'";
            $q_sel = mysqli_query($con, $q);
            while ($row = mysqli_fetch_assoc($q_sel)) {
                $user_id = $row['id'];
            }

            $query = "SELECT * FROM posts ORDER BY p_date DESC";
            $q_select = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($q_select)) {
                $id = $row['p_id'];
                $p_id = $row['author_id'];
                $p_title = $row['p_title'];
                $p_author = $row['p_author'];
                $p_date = $row['p_date'];
                $p_image = $row['p_image'];
                $p_content = $row['p_content'];
                $likes = $row['l_count'];
                $comments = $row['c_count'];

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


                <h6 name="likes-count" style="float:right;color:black;font-weight:bold;"><?php echo $likes ?></h6>

                <span name="like" style="float:right;margin-right:5px;margin-bottom:10px;margin-top:10px;margin-left:10px;font-weight:bold;color:red;" class="glyphicon glyphicon-heart"></span>

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

        <?php include "includes/footer.php"; ?>