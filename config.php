<?php
  $connect = mysqli_connect("localhost", "root", "", "shoe_store_db");

  function h($str){
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
   session_start();
?>

