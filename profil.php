<?php
session_start();

$connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

if (isset($_POST['deco'])) {
    session_unset ();
    header("Location: connexion.php"); 
}

$login = $_SESSION['login'];
$req = mysqli_query($connexion, "SELECT * FROM utilisateurs WHERE login='$login'");
$res = mysqli_fetch_assoc($req);
$prenom = $res['prenom'];
$nom = $res['nom'];
$password = $res['password'];

$modification="";
$formNewLogin="";
$formNewPass="";
$formNewNom="";
$formNewPrenom="";
$same="";
$existe="";
$valide="";
$vide="";
$wrong="";
$delete="";
$oui="";
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
    <title>MyProfil</title>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
            <li><a href="./index.php">Home</a></li>
            
        </ul>
    </nav>
</header>

<main>
    <article class="titre_profil">
        <h1 class="titre_user">My House</h1>
    </article>

    <article class="info">
        <section id="bienvenue">
            <?php
                if (!isset($_SESSION['login'])) {
                    header("Refresh: 2; url=connexion.php");
                    echo "<p>connecte toi.</p><br><p>Redirection...</p>";
                    exit();
                }          
                if (!$connexion) {
                    echo "Erreur connexion";
                    exit();
                }
                else echo "<h3>Bienvenue sur ton profil $login</h3>";
        ?>
        </section>
        <form action="#" method="POST">
            <p>Info</p>
            <?php 
                echo "Login : $login <br>";
                echo "Prénom : $prenom <br>";
                echo "Nom : $nom <br>";
                echo "Mot de passe : $password <br>";

                if (isset($_POST['modifier'])) {
                    $modification =    "Modifier le Login cliquer <input type=\"submit\" name=\"modifierlogin\" value=\"ici\"><br>
                                        Modifier le Nom cliquer <input type=\"submit\" name=\"modifiernom\" value=\"ici\"><br>
                                        Modifier le Prénom cliquer <input type=\"submit\" name=\"modifierprenom\" value=\"ici\"><br>
                                        Modifier le Mot de passe cliquer <input type=\"submit\" name=\"modifierpass\" value=\"ici\"><br>";
                }
            
                if (isset($_POST['modifierlogin'])) {
                    $formNewLogin =  
                        "<form method=\"post\">
                            <input type=\"text\" name=\"newlogin\" id=\"login\" placeholder=\"nouveau login\">
                            <input type=\"submit\" name=\"submitnewlogin\" value=\"valider\">
                        </form>";
                }
            
                if (isset($_POST['submitnewlogin'])) {
                    $newLogin = $_POST['newlogin'];
                    $checklogin = mysqli_query($connexion, "SELECT login FROM utilisateurs WHERE login='$login'");
                    
                    if (!empty(trim($newLogin))) {
                        $query = "UPDATE utilisateurs SET login='" . htmlentities(trim($newLogin)) . "' WHERE login='$login'";
            
                        if ($login == $newLogin) {
                            $same = "utiliser un autre que $login<br>";
                        }
                        
                        elseif (mysqli_num_rows($checklogin) == 0) {
                            $existe = "Le login est déjà utilisé par un autre utilisateur<br>";
                        }
                        
                        elseif (mysqli_query($connexion, $query)) {
                            $valide = "vous modifié '$login' à '$newLogin' <br>";
                            header("Refresh:1");
                            $_SESSION['login'] = $newLogin;
                        }
                        
                    }else {
                        $vide = "Remplissez le formulaire.<br>";
                    }
                }
            
                if (isset($_POST['modifiernom'])) {
                    $formNewNom = 
                        "<form method=\"post\">
                            <input type=\"text\" name=\"newnom\" id=\"nom\" placeholder=\"nouveau Nom\">
                            <input type=\"submit\" name=\"submitnewnom\" value=\"valider\">
                        </form>";
                }
            
                if (isset($_POST['submitnewnom'])) {
                    $newNom = trim($_POST['newnom']);
            
                    if (!empty($newNom)) {
                        $query = "UPDATE utilisateurs SET nom='" . htmlentities(trim($newNom)) . "' WHERE login='$login'";
            
                        if (mysqli_query($connexion, $query)) {
                            $valide = "vous avez bien modifier votre nom($nom) à ($newNom)";
                            header("Refresh:3");
            
                        }
                        
                    }else {
                        $vide = "Remplissez le formulaire.<br>";
                    }
                }
            
                if (isset($_POST['modifierprenom'])) {
                    $formNewPrenom = "
                        <form method=\"post\">
                        <input type=\"text\" name=\"newprenom\" id=\"nom\" placeholder=\"nouveau Prénom\">
                        <input type=\"submit\" name=\"submitnewprenom\" value=\"valider\">
                        </form>
                    ";
                }
            
                if (isset($_POST['submitnewprenom'])) {
                    $newPrenom = trim($_POST['newprenom']);
            
                    if (!empty($newPrenom)) {
                        $query = "UPDATE utilisateurs SET prenom='" . htmlentities($newPrenom) . "' WHERE login='$login'";
            
                        if (mysqli_query($connexion, $query)) {
                            $valide = "vous avez bien modifier votre prénom($prenom) à ($newPrenom)";
                            header("Refresh:1"); 
                        }
                        
                    }else {
                        $vide = "Remplissez le formulaire.<br>";
                    }
                }
            
                if (isset($_POST['modifierpass'])) { 
                    $formNewPass = 
                        "<form method=\"post\">
                            <input type=\"text\" name=\"pass\" id=\"nom\" placeholder=\"Entrer l'ancien Password\"><br>
                            <input type=\"text\" name=\"newpass\" id=\"nom\" placeholder=\"Entrer un nouveau Password\"><br>
                            <input type=\"text\" name=\"confirmnewpass\" id=\"nom\" placeholder=\"Confirmer le nouveau Password\"><br>
                            <input type=\"submit\" name=\"submitnewpass\" value=\"valider\">
                        </form>
                    ";
                }
            
                if (isset($_POST['submitnewpass'])) {
                    $newpassword = trim($_POST['newpass']);
                    $confirm_password = trim($_POST['confirmnewpass']);
                    
                    if (!empty($_POST['pass']) && !empty($newpassword) && !empty($confirm_password)) {
                        $query = "UPDATE utilisateurs SET password='" . htmlentities($newpassword) . "' WHERE login='$login'";
                if ($_POST['pass'] == $password) {
                    if ($newpassword != $confirm_password) {
                        $same = "le mot de passe n'est pas identique.<br>";
                    }
                    
                    elseif (mysqli_query($connexion, $query)) {
                        echo "Le mot de passe a bien été changé";
                        header("Refresh:3"); 
                    }
                }else {
                    $wrong = "Le mot de passe n'est pas correct.";
                    }
                        
                
                    } else {
                        $vide = "Remplissez le formulaire.<br>";
                    }
                
                }
                if (isset($_POST['deconnecter'])) {
                    session_unset ( );
                    header("Location: connexion.php"); 
                    }
            
                if (isset($_POST['supprimer'])) {
                    $delete =  'supprimer votre compte ?<br>
                                <form method="post">
                                <input type="submit" name="oui" value="oui">
                                <input type="submit" name="non" value="non">
                                </form>';
                                }
            
                if (isset($_POST['oui'])) {
                     
                    (mysqli_query($connexion, "DELETE FROM utilisateurs WHERE login = '$login'"));
                    session_unset ( );
                    $oui = "compte supprimé.";
                    header("Refresh:2"); 
                    }
            ?>
            <p>↓ Modifier tes information ici ↓<input type="submit" name="modifier" value="Modifier"></p>
            <p><?php echo $modification ?></p>
            <p><?php echo $formNewLogin ?></p>
            <p><?php echo $formNewNom ?></p>
            <p><?php echo $formNewPrenom ?></p>
            <p><?php echo $formNewPass ?></p>
            <p><?php echo $same ?></p>
            <p><?php echo $existe ?></p>
            <p><?php echo $valide ?></p>
            <p><?php echo $vide ?></p>
            <p><?php echo $wrong ?></p>
            <p>↓ Supprimer votre compte ici ↓<input type="submit" name="supprimer" value="Supprimer"></p>
            <p><?php  echo $delete   ?></p>
            <p><?php  echo $oui   ?></p>
            <input type="submit" name="deco" value="Déconnexion">
        </form>
    </article>
</main>

<footer>
    <li><a><img id="logo-navbar" src="./images/logoibra.png"></a></li>
</footer>

</body>
</html>