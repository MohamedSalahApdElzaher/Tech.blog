<?php

    include "includes/db.php";
    $id=$_GET['id'];
    $query = "DELETE FROM posts WHERE p_id='$id'";
    mysqli_query($con, $query);
    header('location: index.php');
