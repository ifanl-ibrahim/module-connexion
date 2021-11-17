<?php
session_start();
$connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
/*if(isset($connexion)){
    echo 'connexion réussi';
}
*/
// if (isset($_SESSION['login'])) {
//     $name = $_SESSION['login'];
//     echo "Bonjour $name";
// }

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $req = "SELECT * FROM utilisateurs WHERE login = '$login' && password='$password'";
    
    if(mysqli_num_rows(mysqli_query($connexion, $query)) > 0){
        $_SESSION['login'] = $login;
       if ($_POST['login'] == 'admin') {
           header("location: admin.php"); }

       else header("location: profil.php"); }

       else  echo "Le login ou le mot de passe n'est pas correct !";
       }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./module.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="./Images/logoibra.png">
    <link href="https : //fonts.googleapis.com/css2? family= Abril+Fatface & display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./inscription.php">Inscription</a></li>
            <li><a href="./connexion.php">Connexion</a></li>
        </ul>
    </nav>
</header>

<main>
    <!-- zone de connexion -->
            
        <form action="connexion.php" method="POST">
            <h1>Connexion</h1>
            
            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

            <input type="submit" id='submit' value='LOGIN'>


        </form>

    </main>

<footer>
            <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>

</body>
</html>