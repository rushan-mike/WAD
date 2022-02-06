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
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">

                    <div class="col-sm-8">
                    <h2>Message <b>Details</b></h2>
                    </div>

                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Delete/Accept</th>
                    </tr>
                </thead>
                <tbody>

            <?php


                $sql = "SELECT fid, fname, fmail, fmess, ftype, fhash FROM feedback";
                $result = mysqli_query($conn, $sql);
                $userinfo = array();

                    while ($row = mysqli_fetch_assoc($result)){
                        $userinfo[] = $row;
                    }


                if(!$userinfo==0){ 

                    foreach ($userinfo as $user) {
                        
                        echo
                        '<tr>
                            <td>'.$user['fname'].'</td>
                            <td>'.$user['fmail'].'</td>
                            <td>'.$user['fmess'].'</td>
                            <td>';

                            if($user['ftype'] == 'request'){
                                echo
                                '<button class="btn btn-outline-success" form="mess-acc" type="submit" name="acc-mess" value="'.$user['fhash'].'"><span class="fa fa-check"></span></button>
                                <input form="mess-acc" type="hidden" name="acc-type" value="'.$user['fmess'].'" />';
                            }

                            echo
                                '<button class="btn btn-outline-danger" form="mess-del" type="submit" name="del-mess" value="'.$user['fhash'].'"><span class="fa fa-times"></span></button>
                                
                            </td>
                        </tr>';
                        
                    }

                    echo '<form id="mess-del" style="display: none;" action="inc/message.inc.php" method="post"></form>';
                    echo '<form id="mess-acc" style="display: none;" action="inc/accept.inc.php" method="post"></form>';
                }

                else{
                       echo '<td colspan="4">No Messages</td>';
                }
            ?>

                </tbody>
            </table>
        </div>
    </div> 
        



</main>


<?php  
	include 'footer.php'
?>