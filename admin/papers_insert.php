<?php
        include("config.php");

if($_SERVER['REQUEST_METHOD']=='POST') {

    $act = $_POST['act'];
    
    $name = $_POST['name'];
    $degree = $_POST['degree'];
    $lead_author = $_POST['lead_author'];
    $co_author = $_POST['co_author'];
    $year = $_POST['year'];
    $loc = $_POST['loc'];
    $desc = $_POST['desc'];
    $abs = $_POST['abs'];

    if ($act == 1){
        $id = $_POST['id'];
        $query = "update `papers` set PAPER_TITLE='$name', PAPER_CATEGORY=$degree, STUDENT_ID=$lead_author, PAPER_AUTHORS='$co_author', PAPER_BELONGS_TO='$loc', PAPER_PUBLISHED_AT=$year, PAPER_FULL_TEXT_LINK='$desc', PAPER_ABSTRACTION='$abs' where `PAPER_ID` = $id";
        $ret = mysql_query($query,$conn);
                            
    }
    else
        $ret = mysql_query("insert into papers (STUDENT_ID, PAPER_CATEGORY, PAPER_TITLE, PAPER_AUTHORS, PAPER_BELONGS_TO, PAPER_PUBLISHED_AT, PAPER_FULL_TEXT_LINK, PAPER_ABSTRACTION) values($lead_author, $degree, '$name', '$co_author', '$loc', $year, '$desc', '$abs')",$conn);
    if($ret)
        echo "<script>alert('Complete');window.location = 'papers_list.php';</script>";


}
?>