<?php 
	include 'header.php'
?>

<?php 
	if (!isset($_SESSION['uid'])){
    
        header("Location: /php/login.php");
    }
?>

 <main>

<?php 
	require 'inc/dbh.inc.php';
?>

<div class="container">

    <section class="gall">
        <h2>Gallery</h2>


        <?php

            $hash = $_SESSION['uhash'];
            $sql = "SELECT ifhash, ifname,ifmess FROM ifile";
            $result = mysqli_query($conn, $sql);
            $fileinfo = array();
            $number = 0;

            while ($row = mysqli_fetch_assoc($result)){
                $fileinfo[] = $row;
            }


            if(!$fileinfo==0){ 

                foreach ($fileinfo as $file) {

                    if ($file['ifhash'] == $hash){
                    
                        echo '<div class="row"><div class="col"><br><img width="350" src="/uploads/'.$file['ifname'].'"><br>';
                        echo '<h4>'.$file['ifmess'].'</h4></div>';
                        $number++;
                        
                        if (isset($_SESSION['uname'])){
                            echo '<div class="col my-auto"><br>  
                                    <button class="btn btn-outline-danger" form="img-del" type="submit" name="del-image" value="'.$file['ifname'].'"><span class="fa fa-times"></span></button>
                                <br></div>';
                        }

                        echo '</div>';
                    }
                    
                }

                echo '<form id="img-del" style="display: none;" action="inc/image.gal.del.inc.php" method="post"></form>';
                
            }

            if($number == 0){
                echo '<br>No Images<br>';
                echo 'Please Choose an image to upload'; 
            }


        ?>


        <form method="POST" action="/php/inc/upload.inc.php" enctype="multipart/form-data">
            <div class="upload-wrapper">
            <br>
            <br>
            <input type="file" id="file-upload" name="uploadedFile">
            <br>
            <br>
            <input type="text" class="form-control" name="file-message" placeholder="Recipient Email">
            <br>
            <select name="file-status" id="cars">
                <option value="public" selected>Public</option>
                <option value="private">Private</option>
            </select>

            </div>

            <?php

                if (isset($_SESSION['message']) && $_SESSION['message'])
                {
                echo '<br><p class="notification">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                // header("Refresh:2; url=/php/gallery.php");
                }

            ?>
            <br>
            <input type="submit" name="uploadBtn" value="Upload" />
        </form>

    </section>

 </div>

</main>


<?php  
	include 'footer.php'
?>