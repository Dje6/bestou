<?php include('./includes/pdo.php'); ?>
<?php include('./includes/functions.php'); ?>
<?php

$errors = array();
$success = false;

if(!empty($_POST['submit'])) {

  $nickname = secu($_POST['nickname']);
  $email = secu($_POST['email']);
  $password = secu($_POST['password']);
  $password_verify = secu($_POST['password_verify']);

  $verif = verify($nickname, 5, 100, 'Le pseudo');
  if(!empty($verif)) { $errors['nickname'] = $verif; }
  else {

    $sql = "SELECT pseudo FROM users WHERE pseudo = :pseudo";
    $query = $pdo->prepare($sql);
    $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $query->execute();
    $user = $query-fetch();

    if(!empty($user)) {
      $errors['nickname'] = '* Ce pseudo existe déjà';
    }

  }

  $verif = verify($email, 5, 100, 'L\'email', true);
  if(!empty($verif)) { $errors['email'] = $verif; }
  else {

    $sql = "SELECT email FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query-fetch();

    if(!empty($user)) {
      $errors['email'] = '* Cette email existe déjà';
    }

  }

  if($password == $password_verify) {

    $verif = verify($password, 6, 60, 'Le mot de passe');
    if(!empty($verif)) { $errors['password'] = $verif; }

  } else {
    $errors['password'] = '* Vos mots de passe sont different';
  }

  if(count($errors) == 0) {

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $insert = "INSERT INTO users (pseudo, email, password, created_at) VALUES (:pseudo, :email, :hash, NOW())";
    $query = $pdo->prepare($insert);
    $query->bindValue(':pseudo', $nickname, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':hash', $hash, PDO::PARAM_STR);

    if($query->execute()) {
      $success = true;
    }

  }

}

?>
<?php include('./includes/header.php'); ?>

<section class="sigin">

  <form class="form-signin" action="subscribe.php" method="POST">

    <section class="form-group">
      <label for="nickname">
        Pseudo :
        <span class="error"><?php if(!empty($errors['nickname'])) { echo $errors['nickname']; } ?></span>
      </label>
      <input type="text" name="nickname" value="<?php if(!empty($_POST['nickname'])) { echo $_POST['nickname']; } ?>">
    </section>

    <section class="form-group">
      <label for="email">
        Email :
        <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>
      </label>
      <input type="email" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>">
    </section>

    <section class="form-group">
      <label for="password">
        Mot de passe :
        <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
      </label>
      <input type="password" name="password" value="">
    </section>

    <section class="form-group">
      <label for="password_verify">
        Mot de passe verification :
        <span class="error"><?php if(!empty($errors['password_verify'])) { echo $errors['password_verify']; } ?></span>
      </label>
      <input type="password" name="password_verify" value="">
    </section>

    <section class="form-group">
      <input type="submit" name="submit" value="S'inscrire">
    </section>

  </form>

</section>

<?php include('./includes/footer.php'); ?>
