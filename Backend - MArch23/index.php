<?php
    session_start();
    include "./dbconfig.php";

    if(isset($_GET['logout'])) {
        session_destroy();
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <style>
        .bi::before, [class^="bi-"]::before, [class*=" bi-"]::before {
            font-weight: bold !important;
        }

        * {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin:0;
            padding:0;
        }

        header {
            background-color: black;
            text-align: right;
        }

        header>a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            display: inline-block;
            margin: 5px 25px 5px 0px;
        }

        .dropdown {
            display: inline-block;
        }

        .dropbtn {
            background-color: green;
            display: inline-block;
            color: white;
            font-size: 17px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
            padding: 10px 25px;
            border: none;
        }

        .dropdown-content {
            z-index: 100000;
            position: absolute;
            display: none;
            right:0;
            background-color: rgb(213, 213, 213);
        }

        .dropdown:hover .dropbtn {
            background-color: darkgreen;
        }

        .dropdown:hover .dropdown-content {
            display: block ;
        }
        
        .dropdown-content a {
            white-space: nowrap;
            display: block;
            padding: 15px 15px;
            text-decoration: none;
            color: black;
        }

        .dropdown-content a:hover {
            background-color: rgb(166, 166, 166);
        }

        #branding {
            position: relative;
            background-color: #fbc915;
            z-index: 1;
            height: 150px;
        }
        img[src="./assets/images/logo.gif"] {
            height: 150px;
        }
        .left-align {
            position: absolute;
            top: 0;
            left:0;
        }
        .right-align {
            position: absolute;
            top: 0;
            right:0;
        }

        #branding h1 {
            position: absolute;
            top:10px;
            left:160px;
            font-family: fantasy;
            font-size: 75px;
            white-space: nowrap;
            font-weight: normal;
        }

        #branding p {
            position: absolute;
            top:90px;
            left:160px;
            font-size: 18.5px;
            white-space: nowrap;
        }

        #branding form {
            position: relative;
            top: 60px;
            right: 40px;
        }

        #branding form input {
            position: absolute;
            top:0;
            right:0;
            width: 300px;
            height:30px;
            padding:0 30px 0 10px;
            border-radius: 30px;
        }
        #branding form button {
            position: absolute;
            top:0;
            right:0;
            width: 30px;
            height:30px;
            background-color: transparent;
            border:none;
        }

        nav {
            background-color: #333;
        }

        nav ul{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        nav ul  li {
            list-style-type: none;
        }

        nav ul a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-family:Arial, Helvetica, sans-serif;
            display: inline-block;
            padding: 10px 30px;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <header>
        <a href="privacy.html">Privacy Policy</a>
        <a href="tnc.html">Terms & conditions</a>
        
        <?php if(!isset($_SESSION['userid'])) { ?>

        <div class="dropdown">
            <button class="dropbtn">LOGIN</button>
            <div class="dropdown-content">
                <a href="./authentication/login.php">Login into existing account</a>
                <a href="./authentication/register.php">Create a new account</a>
            </div>
        </div>

        <?php } else { ?>

        <div class="dropdown">
            <button class="dropbtn"><?php echo $_SESSION['username'] ?></button>
            <div class="dropdown-content">
                <a href="./authentication/changepwd.php">Change password</a>
                <a href="./index.php?logout=true">Logout</a>
            </div>
        </div>

        <?php } ?>

    </header>

    <section id="branding">
        <div class="left-align">
            <img src="./assets/images/logo.gif" alt="Music Hub">
            <h1>MUSIC HUB</h1>
            <p>------------------------------------------------<br>One stop shop for all your musical needs</p>
        </div>
        <div class="right-align">
            <form method="get" action="search.html">
                <input type="search" name="search" placeholder="search songs, artists or playlists"/>
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </section>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="hits.html">Top Hits</a></li>
            <li><a href="recent.html">Recently Added</a></li>
            <li><a href="fav.html">Favourites</a></li>
            <li><a href="playlist.html">Playlists</a></li>
            <li><a href="about.html">About us</a></li>
        </ul>
    </nav>

    <main class='m-5'>
        <h1 class='text-center'>Out Top Songs</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 m-5">
            
        <?php 
            $sql_query = "SELECT id, name, dor, doa, album, views, singer, composer, songwriter, label, starring, image, link from music ORDER BY name ASC;";
            $result = mysqli_query($conn,$sql_query);
            while($row = mysqli_fetch_array($result)) {
        ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <img src="./assets/musicimg/<?php echo $row['image']?>" class="card-img-top" alt="...">
                        <audio controls>
                            <source src="./assets/music/<?php echo $row['link']?>" />
                        </audio>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <p class="card-text"><?php echo "Album:",$row['album'],"<br>Singer:",$row['singer'],"<br>Composer:",$row['composer'],"<br>Songwriter:",$row['songwriter']?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Views: <?php echo $row['views'] ?></small>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </main>

    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>