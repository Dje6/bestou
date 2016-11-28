<?php include('./includes/pdo.php'); ?>
<?php include('./includes/functions.php'); ?>
<?php

$error = array();
$success = false;
// debug($error);
if (!empty($_POST['submit'])) {

  $pseudo_email = secu($_POST['pseudo']); //Je sécurise le champ identifiant
  $password = secu($_POST['password']);  // Je sécurise le champ password

  // Requete SQL pour savoir si l'user existe dans la bdd
  $sql = "SELECT * FROM users WHERE pseudo = :pseudo_email OR email = :pseudo_email";
  $query = $pdo->prepare($sql);
  $query->bindValue(':pseudo_email',$pseudo_email,PDO::PARAM_STR);
  $query->execute();
  $userExist = $query->fetch();

  // Si le champ identifiant n'est pas vide
  if(!empty($pseudo_email)){
    // Si l'user existe
    if(!empty($userExist)) {
      // Je vérifie si le password est correct
      if(password_verify($password, $user['password'])) {
            $_SESSION['user']= array(
             'pseudo'=> $user['pseudo'],
             'id'=>$user['id'],
             'status'=>$user['status'],
             'ip'=> $_SERVER['REMOTE_ADDR']
           );
          //  Si tout est bon je renvoie vers l'index et l'user est connecté
           header('Location: index.php');
           exit;
          //  Si le mot de passe est incorrect
      } else {
        $error['password'] = 'Votre mot de passe est invalide';
      }
      // Si l'user n'existe pas
    }else {
      $error['pseudo'] = "Ce pseudo n'existe pas";
    }
    // Si le champ identifiant est vide
 } else {
    $error['pseudo'] = "Veuillez rentrer un nom d'utilisateur";
 }








}




?>
<?php include('./includes/header.php'); ?>


<form class="container" action="login.php" method="POST">
  <div class="form-group">
    <label for="pseudo">Pseudo ou Email</label>
    <span><?php if(!empty($error['pseudo'])) { echo $error['pseudo']; } ?></span>
    <input type="text" name="pseudo" value="">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <span><?php if(!empty($error['password'])) { echo $error['password']; } ?></span>
    <input type="password" name="password" value="">
  </div>
  <input type="submit" name="submit" value="Se connecter">
</form>













<?php include('./includes/footer.php'); ?>
