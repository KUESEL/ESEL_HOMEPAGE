<?php
    include("config.php");
    if (array_key_exists("id", $_GET)) {
        $id = $_GET["id"];
        $query = "delete from papers where `PAPER_ID` = $id";
        $res = mysql_query($query, $conn);
        if (!$res) {
            die('Query Error : ' . mysql_error());
        }
        else{
            echo "<script>alert('삭제되었습니다.'); window.location = 'papers_list.php';</script>";
        }
    }

?>