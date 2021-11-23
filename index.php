<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./module.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="shorcut icon" href="./Images/logoibra.png">
    <link href="https : //fonts.googleapis.com/css2? family= Abril+Fatface & display=swap" rel="stylesheet">
</head>
<body>

<header>
    <nav class="nav">
        <!-- menu pc -->
        <ul>
            <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./inscription.php">Inscription</a></li>
            <li><a href="./connexion.php">Connexion</a></li>
        </ul>
    </nav>

    <div class="drop">
            <!-- menu mobil  -->
            <button class="dropbutton"><img id="logo-navbar" src="./images/logoibra.png"></button>
            <div class="container-button">
                <a href="./index.php">Hom</a>
                <a href="./inscription.php">Inscription</a>
                <a href="./connexion.php">Connexion</a>
            </div>
        </div>
</header>

    <div class="logo">
            <img id="logoibrafond" src="./images/logoibrafond.png">
        </div> 

<footer>
    <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>
    
</body>
</html>