<?php
include 'functions.php';

if (!empty($_POST)){
//echo ("var_dump($_POST):");
//var_dump($_POST);

  $data['success'] = true;
  $_POST  = multiDimensionalArrayMap('cleanEvilTags', $_POST);
  $_POST  = multiDimensionalArrayMap('cleanData', $_POST);

  //your email adress 
  $emailTo = "dtp@dilna.cz";  //"info@tamponovytisk.cz"; //"yourmail@yoursite.com";

  //from email adress
  $emailFrom = $_POST["email"]; //"contact@yoursite.com";

  //email subject
  $emailSubject = "Email SPRINTER";

  $name = $_POST["name"];
  $email = $_POST["email"];
  $comment = $_POST["comment"];
    
    if($name == "")
      $data['success'] = false;
    if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) 
      $data['success'] = false;
    if($comment == "")
      $data['success'] = false;

 if($data['success'] == true){
  $message = "<h5>Email z webu Pneumatickerazitko.cz</h5>
              Jméno odesílatele: $name<br>
              Zpráva: $comment";

  $headers = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/html; charset=utf-8" . "\r\n"; 
  $headers .= "From: <$emailFrom>" . "\r\n";
  $uspech = mail($emailTo, $emailSubject, $message, $headers);

  if ($uspech)
  $data['success'] = true;

  echo json_encode($data);
}
}