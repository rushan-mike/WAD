<?php

if (isset($_POST['signup-sub'])) {
    require 'dbh.inc.php';

    $username = $_POST['name'];
    $email = $_POST['mail'];
    $password = $_POST['pass'];
    $passwordRep = $_POST['pass-rep'];
    $usertype = 'user';

    if (empty($username) || empty($email) || empty($password) || empty($passwordRep)) {
        header("Location: /php/signup.php?error=emptyfields&name=" . $username . "&mail=" . $email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: /php/signup.php?error=invalidNameMail");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /php/signup.php?error=invalidMail&name=" . $username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: /php/signup.php?error=invalidName&mail=" . $email);
        exit();
    } elseif ($password !== $passwordRep) {
        header("Location: /php/signup.php?error=passcheck&name=" . $username . "&mail=" . $email);
        exit();
    } else {
        $sql = "SELECT uname FROM users WHERE uname=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/signup.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultchek = mysqli_stmt_num_rows($stmt);
            if ($resultchek > 0) {
                header("Location: /php/signup.php?error=usertaken&mail=" . $email);
                exit();
            } else {
                $sql = "INSERT INTO users(uname, umail, upass, uhash, utype)VALUES(?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: /php/signup.php?error=sqlerror2");
                    exit();
                } else {
                    $hashid=md5(time() . $username);
                    $hashpass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashpass, $hashid, $usertype);
                    mysqli_stmt_execute($stmt);
                    header("Location: /php/signup.php?error=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: /php/signup.php");
    exit();
}
