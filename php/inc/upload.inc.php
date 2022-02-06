<?php

session_start();

require 'dbh.inc.php';

if (isset($_SESSION['uhash'])){

  $hashid = $_SESSION['uhash'];
  $filestatus = $_POST['file-status'];
  $filemessage =$_POST['file-message'];
  $message = '';

  if(filter_var($filemessage, FILTER_VALIDATE_EMAIL)){

    if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
    {
      if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
      {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
    
        // sanitize file-name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;


        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpeg','jpg', 'gif', 'png');
    
        if (in_array($fileExtension, $allowedfileExtensions))
        {
          // directory in which the uploaded file will be moved
          $uploadFileDir = '/Network/WEB/uploads/';
          $dest_path = $uploadFileDir . $newFileName;
    
          if(move_uploaded_file($fileTmpPath, $dest_path)) 
          {
            $sql = "INSERT INTO ifile(ifhash, ifname, ifmess, ifstatus)VALUES(?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                      $message ='SQL error.';
                        
                    } else {

                        mysqli_stmt_bind_param($stmt, "ssss", $hashid, $newFileName, $filemessage, $filestatus);
                        mysqli_stmt_execute($stmt);
                        $message ='File is successfully uploaded.';
                        
                    }

            
          }
          else
          {
            $message = 'Error moving the file to upload directory.';
          }
        }
        else
        {
          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
      }
      else
      {
        $message = 'There is an error in the file upload. (Maximum File Size: 8MB)';
      }
    }
  }
  else
  {
    $message = 'Please enter a valid email.';
  }


  $_SESSION['message'] = $message;
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header("Location: /php/gallery.php");

}

else{

  header("Location: /php/login.php");
}