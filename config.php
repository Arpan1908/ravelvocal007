<?php 
ini_set('display_errors', 1);
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'username');
  
  
  $conn = mysqli_connect(DB_SERVER , DB_USERNAME ,DB_PASSWORD , DB_NAME);
  if($conn==false){
      dir('Error : unable to connect');
  }

?>
