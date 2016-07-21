<?php
    include("config.php");
    if (array_key_exists("id", $_GET)) {
        $id = $_GET["id"];
        $res = mysql_query("select * from photos where PHOTO_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $title = $row['PHOTO_TITLE'];
        $desc = $row['PHOTO_DESC'];
        $place = $row['PHOTO_PLACE'];
    }



if(isset($_POST['title'])){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $place = $_POST['location'];
    $ret = mysql_query("update `photos` set PHOTO_TITLE='$title', PHOTO_DESC='$desc', PHOTO_PLACE='$place' where `PHOTO_ID` = $id",$conn);

}


?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>image upload test</title>
</head>
<body>
    
<form action="" method="post">
            <img src="<?php echo $row['PHOTO_URI'];?>" style="max-width:250px"/>
	        <p>
                <label for="title">제목</label>
                <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $title;?>">
            </p>
            <p>
                <label for="desc">설명</label>
                <textarea name="desc" id="desc" placeholder="DESCRIPTION"><?php echo $desc;?></textarea>

            </p>
            <p>
                <label for="location">장소</label>
                <input type="text" name="location" id="location" placeholder="Loaction" value="<?php echo $place;?>">
            </p>


	<div><input type="submit" name="upload_form" value="업로드" /></div>
    
    
    
	<input type="hidden" name="upload_check" value="true" />
</form>
</body>
</html>