<?php
include "config.php";    //데이터베이스 연결 설정파일


$id = $_POST['member_name'];
$skill1 = $_POST['skill1_name'];
$value1 = explode('%' , $_POST['skill1_val'])[0];
$skill2 = $_POST['skill2_name'];
$value2 = explode('%' , $_POST['skill2_val'])[0];
$skill3 = $_POST['skill3_name'];
$value3 = explode('%' , $_POST['skill3_val'])[0];
$skill4 = $_POST['skill4_name'];
$value4 = explode('%' , $_POST['skill4_val'])[0];
$ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill1', $value1)",$conn);
$ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill2', $value2)",$conn);
$ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill3', $value3)",$conn);
$ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill4', $value4)",$conn);
if(!$ret)
{
    //msg("Query Error : ".mysql_error($conn));
}
else
{
   
    echo "<script>alert('complete');window.location = 'index.php';</script>";

}

?>

