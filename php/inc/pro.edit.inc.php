<?php

session_start();

if (isset($_POST['edit-done'])) {
    require 'dbh.inc.php';

    $edit = $_POST['edit-done'];
    $username = $_POST['name'];
    $email = $_POST['mail'];
    $toggle = $_POST['toggle'];
    $uname = $_SESSION['uname'];

    

        if($toggle == "un"){

            if (empty($username)) {
                header("Location: /php/profile.php?editerror=emptyfield&edit=".$edit."&tsel=".$toggle);
                exit();
            }

            elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                header("Location: /php/profile.php?editerror=invalidName&edit=".$edit."&tsel=".$toggle);
                exit();
            }

            else {
        
                $sql = "SELECT uname FROM users WHERE uname=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: /php/profile.php?editerror=sqlerror1&edit=".$edit."&tsel=".$toggle);
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultchek = mysqli_stmt_num_rows($stmt);
                    if ($resultchek > 0) {
                        header("Location: /php/profile.php?editerror=usertaken&edit=".$edit."&tsel=".$toggle);
                        exit();
                    } else {
                        $sql = "UPDATE `users` SET `uname`=? WHERE `uname`=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: /php/profile.php?editerror=sqlerror2&edit=".$edit."&tsel=".$toggle);
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ss", $username,$uname);
                            mysqli_stmt_execute($stmt);
                            $_SESSION['uname']=$username;
                            header("Location: /php/profile.php?editerror=success&edit=".$edit);
                            exit();
                        }
                    } 
                }
            }
        }

        else if ($toggle == "um" ){

            if (empty($email)) {
                header("Location: /php/profile.php?editerror=emptyfield&edit=".$edit."&tsel=".$toggle);
                exit();
            }

            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: /php/profile.php?editerror=invalidMail&edit=".$edit."&tsel=".$toggle);
                exit();
            }

            else {

                $sql = "UPDATE `users` SET `umail`=? WHERE `uname`=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: /php/profile.php?editerror=sqlerror4&edit=".$edit."&tsel=".$toggle);
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $email,$uname);
                    mysqli_stmt_execute($stmt);
                    $_SESSION['umail']=$email;
                    header("Location: /php/profile.php?editerror=success&edit=".$edit);
                    exit();
                }
            }
        }

        else {
            header("Location: /php/profile.php?editerror=selecttoggle&edit=".$edit."&tsel=".$toggle);
            exit();
        }
  

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}

else {
    header("Location: /php/profile.php?edit=".$edit);
    exit();
}