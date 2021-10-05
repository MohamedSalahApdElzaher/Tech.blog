<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">


        <!-- Blog Entries Column -->
        <div class="col-md-8" style="border-style: groove;border-radius: 5px;">

            <?php

            $id = $_GET['id'];
            $_SESSION['p_id'] = $id;
            $query = "SELECT * FROM posts WHERE p_id='$id'";
            $result = mysqli_query($con, $query);

            ?>


            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $p_title = $row['p_title'];
                $p_author = $row['p_author'];
                $p_date = $row['p_date'];
                $p_image = $row['p_image'];
                $p_content = $row['p_content'];

            ?>


                <!-- First Blog Post -->
                <h2 style="font-weight:bold">
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

        <div class="col-md-4">


            <!-- add comment-->

            <div class="well">
                <h4 style="font-weight:normal">Leave a Comment</h4>
                <form action="controllerUserData.php" method="post">

                    <div class="input-group">
                        <input name="comment_text" type="text" class="form-control" required>
                        <span class="input-group-btn">
                            <button type="submit" name="submit-comment" class="btn btn-default">
                                <span class="glyphicon glyphicon-send"></span>
                            </button>
                        </span>

                    </div>
                </form>
                <!-- /.input-group -->
            </div>


            <!-- All comments-->

            <div class="well">

                <form action="controllerUserData.php" method="post">

                    <div class="input-group">

                        <?php

                        $query = "SELECT * FROM comments WHERE post_id='$id'";
                        $res = mysqli_query($con, $query);

                        if ($res) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                $name = $row['c_author'];
                                $date =  $row['c_date'];
                                $comment =  $row['comment'];
                        ?>

                                <h5 style="font-weight:bold"><span class="glyphicon glyphicon-user">

                                    </span> <?php echo $name ?>&nbsp;&nbsp;&nbsp;<?php echo $date ?></h5>
                                <h6 style="margin-left:20px;"><?php echo $comment ?></h6>

                        <?php

                            }
                        }

                        ?>




                    </div>

                </form>
                <!-- /.input-group -->
            </div>



        </div>

        <!-- /.row -->