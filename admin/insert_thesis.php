<?php
include "config.php";    //데이터베이스 연결 설정파일

$title = $_POST['title'];
$lead_author = $_POST['lead_author'];
$co_author = $_POST['co_author'];
$journal = $_POST['journal'];
$cate = $_POST['cate'];
$abstract = htmlentities($_POST['abstract']);
$year = $_POST['year'];
$link = $_POST['link'];
$journals = preg_replace("/\s+/", "", $journal);
$array_journal = explode(',' , $journals);

$authors = preg_replace("/\s+/", "", $co_author);
$array_author = explode(',' , $authors);

                
$ret = mysql_query("insert into papers (STUDENT_ID, PAPER_CATEGORY, PAPER_TITLE, PAPER_ABSTRACTION, PAPER_AUTHORS, PAPER_BELONGS_TO, PAPER_PUBLISHED_AT, PAPER_FULL_TEXT_LINK) values($lead_author, $cate, '$title','$abstract', '$authors', '$journals', $year, '$link')",$conn);
if(!$ret)
{
    //msg("Query Error : ".mysql_error($conn));
}
else
{
   
    echo "<script>alert('complete');window.location = 'index.php';</script>";

}

?>

