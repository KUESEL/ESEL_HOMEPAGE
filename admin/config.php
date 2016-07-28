<?php
$conn = @mysql_connect("localhost","tolskais" ,"esel10582");
if (!$conn){
    die('Could not connect: ' . mysql_error());
}
mysql_set_charset("utf8", $conn);
mysql_select_db("tolskais", $conn);
$thesis_storage = "./thesis/";
$image_storage = "./profile/";
$research_storage = "./research/";
$article_storage = "./article/";
?>