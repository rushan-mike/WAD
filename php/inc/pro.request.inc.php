<?php

session_start();

if (isset($_POST['req-pro'])) {
    require 'dbh.inc.php';

    $feedname = $_SESSION['uname'];
    $feedemail = $_SESSION['umail'];
    $feedtype = 'request';
    $feedhash = $_SESSION['uhash'];

    if($_POST['req-pro'] == 'pho'){
        $message = 'Request to become a Photographer';
    }
    else if($_POST['req-pro'] == 'adm'){
        $message = 'Request to become a Admin';
    }
    else if($_POST['req-pro'] == 'usr'){
        $message = 'Request to become a User';
    }


    $sql = "SELECT fmail FROM feedback WHERE fhash=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: /php/profile.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $feedhash);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultchek = mysqli_stmt_num_rows($stmt);
        if ($resultchek > 0) {
            header("Location: /php/profile.php?error=inprogress");
            exit();
        } else {
            $sql = "INSERT INTO feedback(fname, fmail, fmess, ftype, fhash) VALUES(?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: /php/profile.php?error=sqlerror2");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sssss", $feedname, $feedemail, $message, $feedtype, $feedhash);
                mysqli_stmt_execute($stmt);
                header("Location: /php/profile.php?error=success");
                exit();
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: /php/profile.php");
    exit();
}
