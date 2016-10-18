<?php
    include("config.php");
    if (array_key_exists("id", $_GET)) {
        $id = mysql_real_escape_string($_GET["id"]);
        $res = mysql_query("select * from photos where `PHOTO_ID` = $id", $conn);
        if($res){
            $row = mysql_fetch_array($res);
            $filename = $row['PHOTO_URI'];
            $query = "delete from photos where `PHOTO_ID` = $id";
            $res = mysql_query($query, $conn);
            if (!$res) {
                die('Query Error : ' . mysql_error());
            }
            else{
                unlink($filename);
                echo "<script>alert('삭제되었습니다.'); window.location = 'photos_list.php';</script>";
            }
        }
    }

?>