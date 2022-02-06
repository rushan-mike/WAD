<?php

session_start();

if (isset($_POST['del-done'])) {

    require 'dbh.inc.php';

    $del=$_POST['del-done'];
    $password = $_POST['delconpass'];
    $uname = $_SESSION['uname'];


    if (empty($password)) {
        header("Location: /php/profile.php?delerror=empty&del=".$del);
        exit();
    }

    else {
        $sql = "SELECT * FROM users WHERE uname=? ;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/profile.php?delerror=sqlerror&del=".$del);
            exit();
        } 
        
        else {
            mysqli_stmt_bind_param($stmt, "s", $uname);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passcheck = password_verify($password, $row['upass']);
                if ($passcheck == false) {
                    header("Location: /php/profile.php?delerror=wrongpass&del=".$del);
                    exit();
                } 
                
                else if ($passcheck == true) {

                    
                        $sql = "DELETE FROM `users` WHERE `uname`=? ;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: /php/profile.php?delerror=sqlerror2&del=".$del);
                            exit();
                        } 
                        else {
                            mysqli_stmt_bind_param($stmt,"s",$uname);
                            mysqli_stmt_execute($stmt);
                            session_unset();
                            session_destroy();
                            header("Location: /php/profile.php?delerror=success&del=".$del);
                            exit();
                        }
                    
                } 
                
            }
        }

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}  

else {
    header("Location: /php/profile.php?del=".$del);
    exit();
}  