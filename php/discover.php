<?php 
	include 'header.php'
?>

 <main>

<?php 
	require 'inc/dbh.inc.php';
?>

<div class="container">
    <section class="disc">
        <h2>Discover</h2>

        <?php

                $sql = "SELECT ifhash, ifname, ifstatus FROM ifile";
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

                        if($file['ifstatus'] == 'public'){
                        
                            echo '<div class="row"><div class="col w-auto"><br><img width="350" src="/uploads/'.$file['ifname'].'"><br>';
                            $number++;

                            foreach ($userinfo as $user) {

                                if($file['ifhash'] == $user['uhash']){
                                    echo '<h4>@'.$user['uname'].'</h4></div>';
                                }
                            }

                            if (isset($_SESSION['utype']) && $_SESSION['utype'] == 'admin'){
                                echo '<div class="col my-auto"><br>
                                        <button class="btn btn-outline-danger" form="img-del" type="submit" name="del-image" value="'.$file['ifname'].'"><span class="fa fa-times"></span></button>
                                    <br></div>';
                            }

                            echo '</div>';

                        }
                        
                    }

                    echo '<form id="img-del" style="display: none;" action="inc/image.del.inc.php" method="post"></form>';
                }

                if($number==0){
                       echo 'No Images';
                }
            ?>

        
    </section>

</div>

</main>



<?php  
	include 'footer.php'
?>