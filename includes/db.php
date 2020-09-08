<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'dgm_crd';


$db = new mysqli($servername, $username, $password,$dbname);

if ($db->connect_error) {
  die("Please import the sql file to the database: " . $conn->connect_error);
}

?>
