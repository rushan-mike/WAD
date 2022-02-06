<?php

session_start();

if (isset($_POST['del-mess'])) {

    require 'dbh.inc.php';

    $feedhash=$_POST['del-mess'];


    $sql = "DELETE FROM feedback  WHERE fhash=? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: /php/message.php?delerror=sqlerror");
        exit();
    } 
    else {
        mysqli_stmt_bind_param($stmt,"s",$feedhash);
        mysqli_stmt_execute($stmt);
        header("Location: /php/message.php?delerror=success");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}  

else {
    header("Location: /php/message.php");
    exit();
}