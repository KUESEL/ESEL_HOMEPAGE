<?php
    include("config.php");
    if (array_key_exists("id", $_GET)) {
        $id = $_GET["id"];
        $res = mysql_query("select * from members where `STUDENT_ID` = $id", $conn);
        if($res){
            $row = mysql_fetch_array($res);
            $name = $row['STUDENT_NAME'];
            $year = $row['ADMISSION_YEAR'];
            $filename = $row['PROFILE_PHOTO_URI'];
            $query = "delete from members where `STUDENT_ID` = $id";
            $res = mysql_query($query, $conn);
            if (!$res) {
                die('Query Error : ' . mysql_error());
            }
            else{
                unlink($filename);
                echo "<script>alert('삭제되었습니다.'); window.location = 'members_list.php';</script>";
            }
        }
    }

?>