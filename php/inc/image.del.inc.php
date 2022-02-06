<?php

session_start();

if (isset($_POST['del-image'])) {

    require 'dbh.inc.php';

    $name=$_POST['del-image'];
    $file_pointer = "/Network/WEB/uploads/".$name;

    if (!unlink($file_pointer)) {  
        header("Location: /php/discover.php?delerror=fileerror");
        exit();
    }

    else {  
        
        $sql = "DELETE FROM ifile  WHERE ifname=? ;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /php/discover.php?delerror=sqlerror");
            exit();
        } 
        else {
            mysqli_stmt_bind_param($stmt,"s",$name);
            mysqli_stmt_execute($stmt);
            header("Location: /php/discover.php?delerror=success");
            exit();
        }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    }

    
}  

else {
    header("Location: /php/discover.php");
    exit();
}