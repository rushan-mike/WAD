<?php

session_start();

if (isset($_POST['pass-done'])) {
    require 'dbh.inc.php';

    $chng = $_POST['pass-done'];
    $passwordOld = $_POST['oldpass'];
    $passwordNew = $_POST['newpass'];
    $passwordCon = $_POST['conpass'];
    $uname = $_SESSION['uname'];


    if (empty($passwordOld) || empty($passwordNew) || empty($passwordCon)) {
        header("Location: /php/profile.php?passerror=empty&chng=".$chng);
        exit();
    }
    else{

    $sql = "SELECT * FROM users WHERE uname=? ;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/profile.php?passerror=sqlerror&chng=".$chng);
            exit();
        } 
        
        else {
            mysqli_stmt_bind_param($stmt,"s", $uname);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passcheck = password_verify($passwordOld, $row['upass']);
                if ($passcheck == false) {
                    header("Location: /php/profile.php?passerror=wrongpass&chng=".$chng);
                    exit();
                } 
                
                else if ($passcheck == true) {

                    if ($passwordNew !== $passwordCon) {
                        header("Location: /php/profile.php?passerror=passcheck&chng=".$chng);
                        exit();
                    }

                    else {
                        $sql = "UPDATE `users` SET `upass`=? WHERE `uname`=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: /php/profile.php?passerror=sqlerror2&chng=".$chng);
                            exit();
                        } 
                        else {
                            $hashpass = password_hash($passwordNew, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $hashpass,$uname);
                            mysqli_stmt_execute($stmt);
                            header("Location: /php/profile.php?passerror=success&chng=".$chng);
                            exit();
                        }
                    }
                    

                    
                } 
                
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}  

else {
    header("Location: /php/profile.php?chng=".$chng);
    exit();
}  