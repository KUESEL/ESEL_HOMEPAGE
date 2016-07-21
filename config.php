<?php
$conn = @mysql_connect("localhost","tolskais" ,"esel10582");
if (!$conn){
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("tolskais", $conn);
$thesis_storage = "./thesis/";
$image_storage = "./profile/";
?>