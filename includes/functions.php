<?php

function debug($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

function secu($val)
{
  return trim(strip_tags($val));
}

function verify($val, $minLength, $maxLenght, $msgerr, $email = false)
{
  $val_secu = secu($val);
  $error = '';

  if(!empty($val_secu)) {

    if(strlen($val_secu) < $minLength) {
      $error = '* ' . $msgerr . ' est trop court';
    }

    if(strlen($val_secu) > $maxLength) {
      $error = '* ' . $msgerr . ' est trop long';
    }

    if($email == true) {

      if(filter_var($val_secu, FILTER_VALIDATE_EMAIL) == false) {
        $error = '* ' . $msgerr . ' n\' est pas un email';
      }

    }

  } else {
    $error = '* Veuillez renseigner ce champs.';
  }

  return $error;

}
