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

function verif($val,$min,$max,$text_error,$verif_mail = false)
{
  $error = '';

  $val_secu = secu($val);


  if(!empty($val_secu)) {
      if(strlen($val_secu) < $min) {
        $error =  'Le '.$text_error.' est trop court';
      } elseif(strlen($val_secu) > $max) {
        $error =  'Le '.$text_error.' est trop long';
      }
      if ($verif_mail == true) {
        if(filter_var($val_secu, FILTER_VALIDATE_EMAIL) == false) {
          $error = 'Votre email n\'est pas valide';
        }
      }

  } else {
    $error = 'Veuillez renseigner ce champs';
  }

  return $error;

}








 ?>
