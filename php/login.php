<?php 
	include 'header.php'
 ?>

<div class="container">

    <div class="row">
        <h2>Login</h2>
        <div class="col">


        </div>


        <div class="col">

        </div>


        </div>
        <div class="row">
        <div class="col">

        </div> 
        <div class="column"> 

        <form action="/php/inc/login.inc.php" method="post">
        <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" placeholder="Username" name="muid" class="form-control" 
        <?php if(isset($_GET['muid'])){
            echo 'value="'.$_GET['muid'].'"';
            }
        ?>>
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" placeholder="Password" name="pass" class="form-control">
        <label>
        <?php
            if(isset($_GET["erro"])){
                $erro=$_GET["erro"];
                if ($erro=="nouser"){
                    echo "User does not exist. Please sign up !!!";
                    header("Refresh:2; url=/php/signup.php");
                }
                else if($erro=="empty"){
                    echo "Please enter a borth a username and password";
                }
                else if($erro=="sqlerror"){
                    echo "";
                }
                else if($erro=="wrongpass"){
                    echo "Password incorrect please try again";
                }
                else if($erro=="success"){
                    echo "You have successfully logged in";
                    header("Refresh:2; url=/php/discover.php");
                }
                else{
                    echo $erro;
                }
                
            }
        ?>
        </label>
        <div>
        <button class="btn btn-secondary btn-lg" type="submit" name="login-sub">Login</button>

        </div>

        </div>

        </form>


        </div>


        <div class="col">

        </div>
    </div>

</div> 



<?php  
	include 'footer.php'
?>