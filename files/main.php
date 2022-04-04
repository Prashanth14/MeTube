<?php
require_once("connection.php");
require_once("Classes/UserDetails.php");
require_once("Classes/Media.php");
require_once("Classes/MediaGrid.php");
require_once("Classes/MediaItem.php");

$loggedInUserName = "";
$page = "";
$category = "";
$sortby = "";
$keywords = "";
$mediaTitle = "";

if (isset($_SESSION["loggedinUser"])) {
    $loggedInUserName = $_SESSION["loggedinUser"];
}
$loggedInUser = new UserDetails($con, $loggedInUserName);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MeTube</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="files/css/style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="files/js/jsfile.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <button class="btn hamburgermenu" style="background-color:'red'">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php?page=Home"><img src="./files/css/meTubeLogo1.jpeg" alt="MeTubeLogo" style="width:150px;height:39px;"> </a>
    <button class="navbar-toggler btn " type="button" data-toggle="collapse" data-target="#navbar-collapse-content"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        Menu <i class="fas fa-caret-square-down"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbar-collapse-content">

        <form class="form-inline my-2 my-lg-0 mr-auto search-bar" action="search.php" method="GET">
            <input class="form-control mr-sm-2 search" list="datalist" onkeyup="ac(this.value)" type="search"
                   placeholder="Search media..." aria-label="Search" name="keywords">
            <button class="btn btn-light  my-2 my-sm-0" type="submit"><img src="./files/css/searchIcon.png" alt="MeTubeLogo" style="width:50px;height:20px;"> </i></button>
        </form>

        <?php
        if ($loggedInUserName != "") {
            echo "<ul class='navbar-nav'>
      <li class='nav-item'>
      <a class='text-success nav-link' href='channels.php'>" . $loggedInUser->getuserName() . " </a>
      </li>
      <li class='nav-item'>
         <a class='nav-link' href='upload.php'>Upload file</a>
      </li>
   
      <li class='nav-item'>
      <a class='nav-link' href='logout.php'>Log Out </a>
      </li>
      </ul>";
        } else {
            echo "<ul class='navbar-nav'>
        <li class='nav-item'>
          <a class='nav-link' href='signup.php'>Sign up <i class='fas fa-user-plus'></i> </a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='login.php'>Log In <i class='fas fa-user'></i></a>
        </li>
      </ul>";
        }
        ?>
    </div>
</nav>


<div id="side-nav" style="display:none;">
    <div class="sidebar-menu">
        <ul style="list-style-type:none;">
            <li class='nav-item'>
                <a href='index.php?page=Home'>Home</a>
            </li>
            <li class='nav-item'>
                <a href='wordCloud.php'>Word Cloud</a>
            </li>
            <?php
            if ($loggedInUserName != "") {
                echo "<li class='nav-item'>
                        <a href='channels.php'>My Channel</a>
                      </li>
                
                     <li class='nav-item'>
                      <a href='updateProfile.php'>Edit Profile</a>
                        </li>
                    
                        <li class='nav-item'>
                        <a href='friend.php'>Contacts</a>
                      </li> 
                      <li class='nav-item'>
                        <a href='message.php'>Messages</a>
                      </li> 
                    
                    <li class='nav-item'>
                      <a href='playlist.php?id='>Playlists</a>
                    </li>
                
                    <li class='nav-item'>
                      <a href='favorites.php'>Favorites</a>
                    </li>
                    
                    <li class='nav-item'>
                      <a href='discussionBoard.php'>Discussion Forum</a>
                    </li>";
            }
            ?>
        </ul>
    </div>

</div>


<div id="main-section">
    <div id="content" class="container-fluid">
