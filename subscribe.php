<?php include('./includes/pdo.php'); ?>
<?php include('./includes/functions.php'); ?>
<?php




?>
<?php include('./includes/headers.php'); ?>


<form class="container" action="" method="POST">
  <div class="form-group">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" value="">
  </div>
  <div class="form-group">
    <label for="email">Email :</label>
    <input type="email" name="email" value="">
  </div>
  <div class="form-group">
    <label for="password">Password :</label>
    <input type="password" name="password" value="">
  </div>
  <div class="form-group">
    <label for="password_repeat">Repeat password :</label>
    <input type="password" name="password_repeat" value="">
  </div>
  <input type="submit" name="submit" value="">
</form>








<?php include('./includes/footer.php'); ?>
