<?php  

  try{
    $db=new PDO("mysql:host=localhost; dbname=hukukburom; charset=utf8",'root','ahdnksamd');
    //echo "Veritabanı bağlantısı başarılı";

  } catch(PDOExpception $e) {
    echo $e->getMessage();
  }

?>