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
    <nav class="nav">
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

<main>
    <!-- zone de connexion -->
            
    <form action="#" method="POST">
        <h1>Connexion</h1>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="login">
        <input type="password" placeholder="Entrer le mot de passe" name="password">
        <input type="submit" id='submit' value='LOGIN'>
    </form>
    <?php
        session_start();

        $connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
        $login = trim($_POST['login']); 
        $password = trim($_POST['password']);

        if($login !== "" && $password !== "") {
            $req = "SELECT count(*) FROM utilisateurs WHERE login = '$login' AND password='$password'";
            $req2 = mysqli_query($connexion,$req);
            $res = mysqli_fetch_array($req2);
            $count = $res['count(*)'];
        
            if($count!=0) {  
                $_SESSION['login'] = $login;
                if ($_POST['login'] == 'admin') {
                   header("location: admin.php");
                }
               else header("location: profil.php");
            }
            else  echo $erreur = "<p id='erreur'>Le login ou le mot de passe n'est pas correct !</p>";  
        }
    ?>

</main>

<footer>
    <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>

</body>
</html>