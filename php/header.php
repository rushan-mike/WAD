<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Photofolio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"  integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styless.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="/Scripts/refresh.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

  <header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
      <a class="navbar-brand" href="/php/home.php">Photofolio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

          <?php

                if (isset($_SESSION['utype']) && $_SESSION['utype'] == 'admin'){
                  echo '<li class="nav-item"><a class="nav-link" href="/php/home.php">Home</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/about.php">About</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/discover.php">Discover</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/message.php">Message</a></li>';

                }
                else if (isset($_SESSION['utype']) && $_SESSION['utype'] == 'photographer') {
                  echo '<li class="nav-item"><a class="nav-link" href="/php/discover.php">Discover</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/about.php">About</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/gallery.php">Gallery</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/contact.php">Contact</a></li>';
                  
                }
                else if (isset($_SESSION['utype']) && $_SESSION['utype'] == 'user') {
                  echo '<li class="nav-item"><a class="nav-link" href="/php/discover.php">Discover</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/about.php">About</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/usergallery.php">Gallery</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/contact.php">Contact</a></li>';

                }
                else{
                  echo '<li class="nav-item"><a class="nav-link" href="/php/home.php">Home</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/about.php">About</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/discover.php">Discover</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="/php/contact.php">Contact</a></li>';

                }

                ?>
            
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <?php

              if (isset($_SESSION['uname'])){
                echo '<li class="nav-item"><a class="nav-link" href="/php/inc/logout.inc.php"><span class="fa fa-sign-out"></span> Logout</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="/php/profile.php"><span class="fa fa-user"></span> Profile</a></li>';

              }
              else{
                echo '<li class="nav-item"><a class="nav-link" href="/php/login.php"><span class="fa fa-sign-in"></span> Login</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="/php/signup.php"><span class="fa fa-plus"></span> Signup</a></li>';
                

              }

            ?> 
            
          </ul>
          
        </div>
  </nav>

  </header>