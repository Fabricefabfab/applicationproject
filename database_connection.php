<?php 

$server = "us-cdbr-east-06.cleardb.net";
$user = "bedb62f2f3a0f9";
$pass = "222e3331";
$database = "capstone";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}
// else{
//     echo"Success!";
// }

?>

