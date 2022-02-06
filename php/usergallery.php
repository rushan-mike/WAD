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
        <h2>User Gallery</h2>

        <?php

                $usermail=$_SESSION['umail'];
                $sql = "SELECT ifhash, ifname, ifmess FROM ifile";
                $result = mysqli_query($conn, $sql);
                $fileinfo = array();
                $number = 0;

                while ($row = mysqli_fetch_assoc($result)){
                    $fileinfo[] = $row;
                }


                if(!$fileinfo==0){ 

                    $sql = "SELECT uhash, uname FROM users";
                    $result = mysqli_query($conn, $sql);
                    $userinfo = array();

                    while ($row = mysqli_fetch_assoc($result)){
                        $userinfo[] = $row;
                    }

                    foreach ($fileinfo as $file) {

                        if($file['ifmess'] == $usermail){
                        
                            echo '<div class="row"><div class="col w-auto"><br><img width="350" src="/uploads/'.$file['ifname'].'"><br>';
                            $number++;

                            foreach ($userinfo as $user) {

                                if($file['ifhash'] == $user['uhash']){
                                    echo '<h4>@'.$user['uname'].'</h4></div>';
                                }
                            }

                            echo '</div>';

                        }
                        
                    }

                    echo '<form id="img-del" style="display: none;" action="inc/image.del.inc.php" method="post"></form>';
                }

                if($number == 0){
                       echo 'No Images';
                }
            ?>

        
    </section>

</div>

</main>



<?php  
	include 'footer.php'
?>