<?php 
	include 'header.php'
 ?>


<div class="container">


  <div class="row">
  
    <div class="col">
    
  
    </div>
    <div class="col">

    </div>
  </div>
  <div class="row">
    <div class="col">
 
    </div>
    <div class="column"> 
    <h2>Sign Up</h2>
    <form action="/php/inc/signup.inc.php" method="post">
    <div class="mb-3">
  <label for="name" class="form-label">Username</label>
  <input type="text" class="form-control" name="name" placeholder="Alphanumeric"
  <?php if(isset($_GET['name'])){
            echo 'value="'.$_GET['name'].'"';
            }
        ?>>
</div>
<div class="mb-3">
  <label for="Email" class="form-label">Email</label>
  <input type="text" class="form-control" name="mail" placeholder="example@mail.com"
  <?php if(isset($_GET['mail'])){
            echo 'value="'.$_GET['mail'].'"';
            }
        ?>>
</div>
<div class="mb-3">
  <label for="Password" class="form-label">Password</label>
  <input type="password" class="form-control" name="pass" placeholder="8-12 characters">
</div>

<div class="mb-3">
  <label for="pass-rep" class="form-label">Verify Password</label>
  <input type="password" class="form-control" name="pass-rep" placeholder="repeat password">
  <label>
        <?php
            if(isset($_GET["error"])){
                $error=$_GET["error"];
                if ($error=="emptyfields"){
                    echo "Please enter all fields";
                }
                else if($error=="invalidNameMail"){
                    echo "Please enter borth a valid username and an email";
                }
                else if($error=="invalidMail"){
                    echo "Please enter a valid email";
                }
                else if($error=="invalidName"){
                    echo "Username must contain alphanumeric characters only";
                }
                else if($error=="passcheck"){
                    echo "Passwords do not match please try again";
                }
                else if($error=="sqlerror1"){
                    echo "";
                }
                else if($error=="usertaken"){
                    echo "Username taken please try again";
                }
                else if($error=="sqlerror2"){
                    echo "";
                }
                else if($error=="success"){
                    echo "You have successfully signed up
                            <br>
                            Please login";
                    header("Refresh:2; url=/php/login.php");
                }
                else{
                    echo $error;
                }
                
            }
        ?>
        </label>
        <div>
        <button class="btn btn-secondary btn-lg" type="submit" name="signup-sub">Signup</button>
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