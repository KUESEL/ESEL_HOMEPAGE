<?php include("session.php") ?>
<?php
    include("config.php");
    if (array_key_exists("id", $_GET)) {
        $id = $_GET["id"];
        $res = mysql_query("select * from thesis where `index` = $id", $conn);
        $row = mysql_fetch_array($res);
        $title = $row['title'];
        $lead_author = $row['lead_author'];
        $abstract = $row['abstract'];
        $year = $row['year'];
        $path = $row['path'];
        $upload = $row['upload'];
        $res = mysql_query("select * from author where `index` = $id", $conn);
        $i = 0;
        $co_author = "";
        while($row = mysql_fetch_array($res)){
            if($i==0)
                $co_author = $co_author.$row[1];
            else
                $co_author = $co_author.", ".$row[1];
            $i++;
        }
        $res = mysql_query("select * from journal where `index` = $id", $conn);
        $i = 0;
        $journal = "";
        while($row = mysql_fetch_array($res)){
            if($i==0)
                $journal = $journal.$row[1];
            else
                $journal = $journal.", ".$row[1];
            $i++;
        }

    }
?>

<!DOCTYPE html>
<html lang='ko'>
    <head>
        <title>Test page for server-side</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <fieldset><legend>논문 상세보기</legend>



            <p>
                <strong><?php echo $title;?></strong>
                <?php if($upload==1){?>
                <a href="<?php echo $path;?>">download</a>
                <?php }?>
            </p>
            <p>
                <strong>주 저자</strong>
                <label for="lead_author"><?php echo $lead_author;?></label>
            </p>
            <p>
                <strong>공동 저자</strong>
                <label for="lead_author"><?php echo $co_author;?></label>
            </p>
            <p>
                <strong>학회/저널</strong>
                <label for="journal"><?php echo $journal;?></label>
            </p>
            <p>
                <strong>초록</strong>
                <textarea name="abstract" id="abstract" placeholder="Abstract of thesis" readonly><?php echo $abstract;?></textarea>
            </p>
            <p>
                <strong>년도</strong>
                <label for="year"><?php echo $year;?></label>
            </p>

        </fieldset>
    </body>
</html>
