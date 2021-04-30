<?php
//header("Content-type: text/html; latin2_hungarian_ci");
$servername = "localhost";
$db_username = "root";
$db_passwd = "";
$dbname = "web1beadando";
 
$conn = mysqli_connect($servername, $db_username, $db_passwd, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
