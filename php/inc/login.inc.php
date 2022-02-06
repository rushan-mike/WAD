<?php

if (isset($_POST['login-sub'])) {

    require 'dbh.inc.php';


    $mailuid = $_POST['muid'];
    $password = $_POST['pass'];

    if (empty($mailuid) || empty($password)) {
        header("Location: /php/login.php?erro=empty&muid=".$mailuid);
        exit();
    } 
    else{ 
        $sql = "SELECT * FROM users WHERE uname=? OR umail=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/login.php?erro=sqlerror");
            exit();
        } 
        
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passcheck = password_verify($password, $row['upass']);
                if ($passcheck == false) {
                    header("Location: /php/login.php?erro=wrongpass&muid=".$mailuid);
                    exit();
                } 
                
                else if ($passcheck == true) {
                    session_start();
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['uname'] = $row['uname'];
                    $_SESSION['umail'] = $row['umail'];
                    $_SESSION['uhash'] = $row['uhash'];
                    $_SESSION['utype'] = $row['utype'];

                    header("Location: /php/login.php?erro=success");
                    exit();
                } 
                
            }

            else {
                header("Location: /php/login.php?erro=nouser");
                exit();
            }
        }    
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 

else {
    header("Location: /php/login.php");
    exit();
}
