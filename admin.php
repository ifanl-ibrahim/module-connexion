<?php
session_start();

if (isset($_POST['deco'])) {
    session_destroy ( );
    header("Location: connexion.php");}

if (!isset($_SESSION["login"])) {
    header("Refresh: 2; url=connexion.php");
    echo "<p>Tu ne peux pas accéder a cette page.</p><br><p>Redirection en cours...</p>";
    exit(0);
}
if ($_SESSION["login"] != "admin") {
    header("Refresh: 2; url=profil.php");
    echo "<p>Vous n'etes pas un admin</p><br><p>Redirection en cours...</p>";
    exit(0);
}

$connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
$query = mysqli_query($connexion, 'SELECT * FROM `utilisateurs`');
$res = mysqli_fetch_all($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./module.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="./images/logoibra.png">
    <link href="https : //fonts.googleapis.com/css2? family= Abril+Fatface & display=swap" rel="stylesheet">
    <title>Admin</title>
</head>
<body>

<header>
    <nav class="nav">
        <ul>
            <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./profil.php">House</a></li>
            <li><a href='./admin.php'>Admin House</a></li>
        </ul>
    </nav>

    <div class="drop">
            <!-- menu mobil  -->
            <button class="dropbutton"><img id="logo-navbar" src="./images/logoibra.png"></button>
            <div class="container-button">
                <a href="./index.php">Home</a>
                <a href="./profil.php">House</a>
                <a href='./admin.php'>Admin House</a>
            </div>
        </div>
</header>

<main>
    <article class="titre_profil">
        <h1 class="titre_user">Admin House</h1>
    </article>

    <article class="info">
        <form action="#" method="POST">
            <p>Info</p>
            <table border='1'>
                <?php
                foreach ($res as $key) {
                    echo "<tr>";
                
                foreach ($key as $value) {
                    echo "<td>$value</td>";
                }
                    echo "</tr>";
                }
                ?>
            </table>
            <input type="submit" name="deco" value="Déconnexion">
        </form>
    </article>
</main>

<footer>
    <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>

</body>
</html>