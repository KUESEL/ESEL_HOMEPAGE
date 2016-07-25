<html lang='ko'>
    <head>
        <title>Test page for server-side</title>
        <meta charset="UTF-8">
    </head>
<script>        
function returnvalue(value) {
  alert(value);
  window.opener.getReturnValue(value);
  window.close();
}
</script>

    <body>
        <form action="" method="post">
            <p>
                <label for="name">이름</label>
                <input type="text" name="name"/>
                <input type="submit" value="검색"/>
            </p>
        </form>

<?php
include "config.php";    //데이터베이스 연결 설정파일
if (array_key_exists("name", $_POST)) {
?>

<?php
    
    $search_keyword = $_POST["name"];
    $query = "select * from members";
    $query =  $query . " where STUDENT_NAME like '%$search_keyword%'";
    $res = mysql_query($query, $conn);
    if (!$res) {
        die('Query Error : ' . mysql_error());
    }
    else{
        if (mysql_num_rows($res) == 0)
            echo "검색 결과가 없습니다.";
        else
            while($row = mysql_fetch_array($res)){
                $Name[] = $row;

                echo $row['STUDENT_NAME']." / ".$row['STUDENT_NUMBER']." / ".$row['ADMISSION_YEAR'];
                $query = "select * from skills where STUDENT_ID=".$row['STUDENT_ID'];
                $ret = mysql_query($query, $conn);
                $value = "{id:'".$row['STUDENT_ID']."'";
                $i = 1;
                while($skill = mysql_fetch_array($ret)){
                    $value = $value.", skill".$i.":'".$skill['SKILL_NAME']."'";
                    $value = $value.", value".$i.":'".$skill['SKILL_SCORE']."'";
                    $i++;
                }
                $value = $value."}"
?>
                <input type="button" value="선택" onclick="returnvalue(<?php echo $value;?>);"/>
<?php

                    echo "<br/>";
            }
    }
    
}

?>        
        
    </body>
</html>
        