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
    <nav class="nav">
        <ul>
            <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
            <li><a href="./index.php">Hom</a></li>
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
    <form method="post">
    <h1>Inscription</h1>
    <input type="text" placeholder="Login" name="login"/><br/>
    <input type="text" placeholder="Prenom" name="prenom"/><br/>
    <input type="text" placeholder="Nom" name="nom"/><br/>
    <input type="password" placeholder="Mot de passe" name="password"/><br/>
    <input type="password" placeholder="Confirmation du mot de passe" name="confirm_password"/><br/>
    <input type="submit" name="submit"/>
    </form>

    <section class="erreur">
        <?php
        session_start();

        $connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

        if(isset($_POST['submit'])){
            $login = trim($_POST['login']);
            $prenom = trim($_POST['prenom']);
            $nom = trim($_POST['nom']);
            $password = trim($_POST['password']);
            $confirm = trim($_POST['confirm_password']);
            $verif = "SELECT login FROM utilisateurs WHERE login = '$login'";
            $verif_suite = mysqli_query($connexion, $verif);
        
        
            if(!empty($login) && !empty($prenom) && !empty($nom) && !empty($password) && !empty($confirm)) {
                if(mysqli_num_rows($verif_suite) == 0){  //calcule et verifie dans la base de donnée 
                    if($password == $confirm) { 
                        $query = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '$password')"; //ajoute les info dans la base de donnée
                        mysqli_query($connexion, $query);
                        header("Location:connexion.php"); //redigire vers la page connexion
                    }
                    else echo $erreur = '<p id="erreur">Les mots de passe ne sont pas identiques.</p>';
                } 
                else echo $erreur = '<p id="erreur">Ce login existe déja</p>';
            }
            else echo $erreur = '<p id="erreur">Veuillez remplir le formulaire s\'il vous plait !</p>';
        }
        ?>
    </section>

</main>

<footer>
    <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>

</body>
</html>