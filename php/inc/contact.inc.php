<?php

session_start();

if (isset($_POST['contact-sub'])) {
    require 'dbh.inc.php';

    $feedname = $_POST['name'];
    $feedemail = $_POST['mail'];
    $message = $_POST['mess'];
    $feedtype = 'normal';
    $feedhash = md5(time() . $feedemail);

    if (empty($feedname) || empty($feedemail) || empty($message)) {
        header("Location: /php/contact.php?error=emptyfields&name=" . $feedname . "&mail=" . $feedemail);
        exit();
    } elseif (!filter_var($feedemail, FILTER_VALIDATE_EMAIL)) {
        header("Location: /php/contact.php?error=invalidMail&name=" . $feedname);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $feedname)) {
        header("Location: /php/contact.php?error=invalidName&mail=" . $feedemail);
        exit();
    } else {
        $sql = "SELECT fmail FROM feedback WHERE fmail=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/contact.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $feedemail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultchek = mysqli_stmt_num_rows($stmt);
            if ($resultchek > 0) {
                header("Location: /php/contact.php?error=mailtaken&mail=" . $feedemail);
                exit();
            } else {
                $sql = "INSERT INTO feedback(fname, fmail, fmess, ftype, fhash) VALUES(?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: /php/contact.php?error=sqlerror2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $feedname, $feedemail, $message, $feedtype, $feedhash);
                    mysqli_stmt_execute($stmt);
                    header("Location: /php/contact.php?error=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: /php/contact.php");
    exit();
}
