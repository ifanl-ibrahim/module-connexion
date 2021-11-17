<?php

$bdd = mysqli_connect('localhost','root','','jour08');

$req = mysqli_query($bdd,'SELECT * FROM etudiants');

$res = mysqli_fetch_all($req);

/*Inscription*/

$connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
/*if(isset($connexion)){
    echo 'connexion réussi';
}
*/
    $login = '';
    $prenom = '';
    $nom = '';
    $password = '';
    $confirm = '';

if(isset($_POST['submit'])){
    $login = trim($_POST['login']);
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);
    
    $verif = "SELECT login FROM utilisateurs WHERE login = '$login'";
    $verif_suite = mysqli_query($connexion, $verif);
    
    
    if(!empty($login) && !empty($prenom) && !empty($nom) && !empty($password) && !empty($confirm)){
    if(mysqli_num_rows($verif_suite) == 0){
    if($password == $confirm){
    $query = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '$password')";
    mysqli_query($connexion, $query);
    header("Location:connexion.php");
    
    }else
    echo 'Les mots de passe ne sont pas identiques.';
    }else 
    echo 'Ce login existe déja';
    }
    else
    echo 'Veuillez remplir le formulaire s\'il vous plait ! ';
    }

/*Inscription*/

/*Connection*/

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

/*Connection*/

?>