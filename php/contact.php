<?php 
include 'header.php'
?>


<div class="container">
<div class="row">

<h2>Contact</h2>

<div>

<div class="row">
        <div class="col">

<div class="boc">
<p>If you have any questions or queries a member of staff will always be happy to help. Feel free to contact us by telephone or email and we will be sure to get back to you as soon as possible.<p>

</div>
       
        <div class="boc">
        <h4>Address:</h4> <p> 120/5, <br> Wijerama Mawatha,  <br> Colombo,  <br> Western Province 0070094103</p>
                
        </div>
            
         <div class="boc">
         <h4> Email:</h4> <p>contact@mrblog.com</p>
         </div>

         
        <div class="boc">
        <h4> Telephone: </h4> <p>707-221-7863</p>
        </div>
         

        


        </div>
        <div class="col">
<form action="/php/inc/contact.inc.php" method="post" >

    <label for="name" class="form-label">Username</label>

<input type="text" name="name" placeholder="Your Name" class="form-control"
<?php if(isset($_GET['name'])){
        echo 'value="'.$_GET['name'].'"';
    }
    else if(isset($_SESSION['uname'])){
        echo 'value="'.$_SESSION['uname'].'"';
    }
?>>

<label for="umail" class="form-label"> Email </label>
<input type="text" name="mail" placeholder="Your Email" class="form-control"
<?php if(isset($_GET['umail'])){
        echo 'value="'.$_GET['umail'].'"';
    }
    else if(isset($_SESSION['umail'])){
        echo 'value="'.$_SESSION['umail'].'"';
    }
?>>

<label for="mess" class="form-label">Message</label>
<input type="text" name="mess" placeholder="Your Message" class="form-control">
<br>
<label>
<?php
    if(isset($_GET["error"])){
        $error=$_GET["error"];
        if ($error=="emptyfields"){
            echo "Please enter all fields";
        }
        else if($error=="invalidMail"){
            echo "Please enter a valid email";
        }
        else if($error=="invalidName"){
            echo "Name must contain alphanumeric characters only";
        }
        else if($error=="sqlerror1"){
            echo "";
        }
        else if($error=="mailtaken"){
            echo "You have inquired us once before
            <br>
            We will get back to you shortly";
        }
        else if($error=="sqlerror2"){
            echo "";
        }
        else if($error=="success"){
            echo "Message successfully sent";
        }
        else{
            echo $error;
        }
        
    }
?>
</label>
<button class="btn btn-secondary btn-lg" type="submit" name="contact-sub">Send</button>


</form>


        </div>
</div>



</div>



        
<?php  
include 'footer.php'
?>