<?php

session_start();

if (isset($_POST['acc-mess'])) {

    require 'dbh.inc.php';

    $userhash=$_POST['acc-mess'];
    $messagetype = 'normal';

    if($_POST['acc-type'] == 'Request to become a Photographer'){
        $usertype = 'photographer';
    }
    else if($_POST['acc-type'] == 'Request to become a Admin'){
        $usertype = 'admin';
    }
    else if($_POST['acc-type'] == 'Request to become a User'){
        $usertype = 'user';
    }


    $sql = "UPDATE users SET utype=? WHERE uhash=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: /php/message.php?accerror=sqlerror1");
        exit();
    } 
    else {
        mysqli_stmt_bind_param($stmt,"ss", $usertype, $userhash);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE feedback SET ftype=? WHERE fhash=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/message.php?accerror=sqlerror2");
            exit();
        }

        else {
            mysqli_stmt_bind_param($stmt,"ss", $messagetype, $userhash);
            mysqli_stmt_execute($stmt);
            header("Location: /php/message.php?accerror=success");
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}  

else {
    header("Location: /php/message.php");
    exit();
}