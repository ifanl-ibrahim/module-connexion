<?php
$connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

if(isset($_POST['submit'])){
    $login = trim($_POST['login']);
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);
    
    $verif = "SELECT login FROM utilisateurs WHERE login='" . $login . "'";
    $verif_suite = mysqli_query($connexion, $verif);
    
    
    if (isset($login) && isset($prenom) && isset($nom) && isset($password) && isset($confirm)){
        if (mysqli_num_rows($verif_suite) == 0){
            if ($password == $confirm){
                $query = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '$password')";
                mysqli_query($connexion, $query);
                header("Location:connexion.php");
            } else {
                echo 'Les mots de passe ne sont pas identiques.';
            }
        } else {
            echo 'Ce login existe déja';
        }
    } else {
        echo 'Veuillez remplir le formulaire s\'il vous plait ! ';
    }
};
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./module.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="shorcut icon" href="./Images/logoibra.png">
    <link href="https : //fonts.googleapis.com/css2? family= Abril+Fatface & display=swap" rel="stylesheet">
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

    <form method="post">
    <h1>Inscription</h1>
    <input type="text" placeholder="Login" name="pseudo"/></label><br/>
    <input type="text" placeholder="Prenom" name="prenom"/></label><br/>
    <input type="text" placeholder="Nom" name="nom"/></label><br/>
    <input type="password" placeholder="Mot de passe" name="passe"/></label><br/>
    <input type="password" placeholder="Confirmation du mot de passe" name="passe2"/></label><br/>
    <input type="submit" value="M'inscrire"/>
    </form>

<footer>
    <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>

</body>
</html>
