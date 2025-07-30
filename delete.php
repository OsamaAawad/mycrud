<?php 
include "db.php";
if(isset($_GET["id"]))
    $id = $_GET["id"];

$deleteClient = "DELETE FROM clients WHERE id = $id";
$result = mysqli_query($conn, $deleteClient);

if(!$result){
    die("Invalid Query".mysqli_error($conn));
}
header("location: index.php");
exit;
?>