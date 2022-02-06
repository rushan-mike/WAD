<?php 
	include 'header.php'
?>

<?php 
	if (!isset($_SESSION['uid'])){
    
        header("Location: /php/login.php");
    }
?>


<div class="container">



<div class="row">


<div class="col">
<h2>User Profile</h2>
        <br>
        <br>
        <h4>Username :  <?php echo $_SESSION['uname']?></h4>
        <br>
        <h4>Email :  <?php echo $_SESSION['umail']?></h4>
        <br>
        <h4>Type :  <?php echo $_SESSION['utype']?></h4>
        <br>
        <br>
</div>



<div class="col" style="width: 500px;">

<?php 

if(isset($_POST['edit']) || isset($_GET['edit'])){
   echo '<form action="/php/inc/pro.edit.inc.php" method="post">

    <label class="form-label" for="toggle"><h4> Select to Customize :</h4></label>
    <br> 
    <input class="form-control" type="text" name="name" placeholder="Your New Username">
    <input type="radio" name="toggle" value="un"';
    if(isset($_GET['tsel']) && $_GET['tsel'] == 'un'){
           echo 'checked';
        }
    echo '/>
    <br>
    <br>
    <input class="form-control" type="text" name="mail" placeholder="Your New Email">
    <input  type="radio" name="toggle" value="um"';
    if( isset($_GET['tsel']) && $_GET['tsel'] == 'um'){
           echo 'checked';
        }
    echo '/>
    <br>';
    if(isset($_GET["editerror"])){
            $editerror=$_GET["editerror"];
            echo '<br>';

            if ($editerror=="selecttoggle"){
                echo "Please select the field";
            }
            else if ($editerror=="emptyfield"){
                echo "Please enter selected field";
            }
            else if($editerror=="invalidNameMail"){
                echo "Please enter borth a valid username and an email";
            }
            else if($editerror=="invalidMail"){
                echo "Please enter a valid email";
            }
            else if($editerror=="invalidName"){
                echo "Username must contain alphanumeric characters only";
            }
            else if($editerror=="sqlerror1"){
                echo "";
            }
            else if($editerror=="sqlerror2"){
                echo "";
            }
            else if($editerror=="usertaken"){
                echo "Username taken please try again";
            }
            else if($editerror=="sqlerror4"){
                echo "";
            }
            else if($editerror=="success"){
                echo "Edit successfull";
            }
            else{
                echo $editerror;
            }

            echo '<br>';
    }
   echo '<br>
    <button class="btn btn-secondary btn-lg" type="submit" name="edit-done">Update</button>
</form>

<br>



<br>
<form action="/php/profile.php">
    <button class="btn btn-secondary btn-lg" type="submit" >Cancel</button>
</form>';

}

else if(isset($_POST['chng']) || isset($_GET['chng'])){
   echo '<form action="/php/inc/pro.pass.inc.php" method="post">

    <input class="form-control" type="password" placeholder="Old Password" name="oldpass">
    <br>
    <br>
    <input class="form-control"  type="password" placeholder="New Password" name="newpass">
    <br>
    <br>
    <input class="form-control" type="password" placeholder="Confirm Password" name="conpass">
    <br>';
    

    if(isset($_GET["passerror"])){
            $passerror=$_GET["passerror"];
            echo '<br>';
            
            if ($passerror=="empty"){
                echo "Please enter all fields";
            }
            else if($passerror=="sqlerror"){
                echo "";
            }
            else if($passerror=="wrongpass"){
                echo "Old password incorrect";
            }
            else if($passerror=="passcheck"){
                echo "New passwords do not match please try again";
            }
            else if($passerror=="sqlerror2"){
                echo "";
            }
            else if($passerror=="success"){
                echo "Successfull changed";
            }
            else{
                echo $passerror;
            }

            echo '<br>';
        }

   echo '<br>
  <button class="btn btn-secondary btn-lg" type="submit" name="pass-done">Change</button>
</form>

<br>

<form action="/php/profile.php">
    <button class="btn btn-secondary btn-lg" type="submit" >Cancel</button>
</form>';

}

else if(isset($_POST['del']) || isset($_GET['del'])){
   echo '<form action="/php/inc/pro.del.inc.php" method="post">

    <input class="form-control" type="password" placeholder="Confirm Password" name="delconpass">
    <br>';
    
    
    if(isset($_GET["delerror"])){
            $delerror=$_GET["delerror"];
            echo '<br>';
            
            if ($delerror=="empty"){
                echo "Please enter Your passsword";
            }
            else if($delerror=="sqlerror"){
                echo "";
            }
            else if($delerror=="wrongpass"){
                echo "Password incorrect";
            }
            else if($delerror=="sqlerror2"){
                echo "";
            }
            else if($delerror=="success"){
                echo "Account successfull deleted";
            }
            else{
                echo $delerror;
            }

            echo '<br>';
        }

   echo '<br>
   <button class="btn btn-danger btn-lg" type="submit" name="del-done">Delete Account</button>
</form>

<br>



<br>
<form action="/php/profile.php">
    <button class="btn btn-secondary btn-lg" type="submit" >Cancel</button>
</form>';

}

else{

    if(isset($_SESSION['utype']) && $_SESSION['utype']=='user'){

        echo '
        <br>
        <button form="pro-req" class="btn btn-secondary btn-lg" type="submit" name="req-pro" value="pho">Request to become a Photographer</button>';
    }

    else if(isset($_SESSION['utype']) && $_SESSION['utype']=='photographer'){

        echo '
        <br>
        <button form="pro-req" class="btn btn-secondary btn-lg" type="submit" name="req-pro" value="adm">Request to become a Admin</button>
        <button form="pro-req" class="btn btn-secondary btn-lg" type="submit" name="req-pro" value="usr">Request to become a User</button>';
    }

    else if(isset($_SESSION['utype']) && $_SESSION['utype']=='admin'){

        echo '
        <br>
        <button form="pro-req" class="btn btn-secondary btn-lg" type="submit" name="req-pro" value="pho">Request to become a Photographer</button>';
    }
   
   
    echo '

<br>

    <button form="pro-set" class="btn btn-secondary btn-lg" type="submit" name="edit">Edit details</button>

<br>

    <button form="pro-set" class="btn btn-secondary btn-lg" type="submit" name="chng">Change Password</button>

<br>

    <button form="pro-set" class="btn btn-secondary btn-lg" type="submit" name="del">Delete Account Permanatly</button>
    <form id="pro-set" style="display: none;" action="/php/profile.php" method="post"></form>
    <form id="pro-req" style="display: none;" action="/php/inc/pro.request.inc.php" method="post"></form>';


}

?>

</div>

</div>




</div>



<?php  
	include 'footer.php'
?>