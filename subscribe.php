<?php include('./includes/pdo.php'); ?>
<?php include('./includes/functions.php'); ?>
<?php


?>
<?php include('./includes/header.php'); ?>

<section class="sigin">

  <form class="form-signin" action="subscribe.php" method="POST">

    <section class="form-group">
      <label for="nickname">
        Pseudo :
        <span class="error"></span>
      </label>
      <input type="text" name="nickname" value="">
    </section>

    <section class="form-group">
      <label for="email">
        Email :
        <span class="error"></span>
      </label>
      <input type="email" name="email" value="">
    </section>

    <section class="form-group">
      <label for="password">
        Mot de passe :
        <span class="error"></span>
      </label>
      <input type="password" name="password" value="">
    </section>

    <section class="form-group">
      <label for="password_verify">
        Mot de passe verification :
        <span class="error"></span>
      </label>
      <input type="password" name="password_verify" value="">
    </section>

    <section class="form-group">
      <input type="submit" name="submit" value="S'inscrire">
    </section>

  </form>

</section>

<?php include('./includes/footer.php'); ?>
