<?php include('./includes/pdo.php'); ?>
<?php include('./includes/functions.php'); ?>
<?php

$error = array();
$success = false;

if (!empty($_POST['submit'])) {

  $pseudo = secu($_POST['pseudo']);
  $email = secu($_POST['email']);
  $password = secu($_POST['password']);
  $password_repeat = secu($_POST['password_repeat']);

  $verif = verif($pseudo,5,20,'Pseudo');
    if (!empty($verif)) {
      $error['pseudo'] = $verif;
    } else {
      $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
      $query = $pdo->prepare($sql);
      $query->bindvalue(':pseudo',$pseudo,PDO::PARAM_STR);
      $query->execute();
      $pseudo_exist = $query->fetch();

        if (!empty($pseudo_exist)) {
          $error['pseudo'] = "Ce pseudo existe déjà";
        }
    }


  $verif = verif($email,5,20,'email',true);
    if (!empty($verif)) {
      $error['email'] = $verif;
    } else {
      $sql = "SELECT * FROM users WHERE email = :email";
      $query = $pdo->prepare($sql);
      $query->bindvalue(':email',$email,PDO::PARAM_STR);
      $query->execute();
      $email_exist = $query->fetch();

        if(!empty($email_exist)) {
          $error['email'] = "Cet email existe déjà PD !";
        }
    }

  if ($password == $password_repeat) {
    $verif = verif($password,5,20,'password');
    if(!empty($verif)) {
      $error['password'] = $verif;
    }
  } else {
    $error['password'] = 'Les deux mots de passe sont différents';
  }

  if (count($error) == 0) {

    $hash = password_hash($password,PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(pseudo,email,password) VALUES (:pseudo, :email, :password)";
    $query = $pdo->prepare($sql);
    $query->bindvalue(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->bindvalue(':email',$email,PDO::PARAM_STR);
    $query->bindvalue(':password',$hash,PDO::PARAM_STR);
    $query->execute();

    $success = true;
  }
}
?>
<?php include('./includes/header.php'); ?>


<form class="container" action="subscribe.php" method="POST">
  <div class="form-group">
    <label for="pseudo">Pseudo :</label>
    <span class="alert"><?php if(!empty($error['pseudo'])) { echo $error['pseudo']; } ?></span>
    <input type="text" name="pseudo" value="">
  </div>
  <div class="form-group">
    <label for="email">Email :</label>
    <span class="alert"><?php if(!empty($error['email'])) { echo $error['email']; } ?></span>
    <input type="email" name="email" value="">
  </div>
  <div class="form-group">
    <label for="password">Password :</label>
    <span class="alert"><?php if(!empty($error['password'])) { echo $error['password']; } ?></span>
    <input type="password" name="password" value="">
  </div>
  <div class="form-group">
    <label for="password_repeat">Repeat password :</label>
    <input type="password" name="password_repeat" value="">
  </div>
  <input type="submit" name="submit" value="Clique ici K1LU4K">
</form>








<?php include('./includes/footer.php'); ?>
