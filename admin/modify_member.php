<?php include("session.php") ?>
<?php
    include("config.php");
    if (array_key_exists("id", $_GET)) {
        $id = $_GET["id"];
        $res = mysql_query("select * from members where STUDENT_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $name = $row['STUDENT_NAME'];
        $year = $row['ADMISSION_YEAR'];
        $degree = $row['DEGREE'];
        $gyear = $row['GRADUATE_YEAR'];
        $filename = $row['PROFILE_PHOTO_URI'];
        $desc = $row['DESCP'];
        $number = $row['STUDENT_NUMBER'];
    }



if(isset($_POST['name'])){
    $name = $_POST['name'];
    $year = $_POST['year'];
    $degree = $_POST['degree'];
    $desc = $_POST['desc'];
    $gyear = $_POST['gyear'];
    $number = $_POST['number'];
}
if (isset($_POST['upload_check'])) {

	if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		if (in_array($_FILES['upload']['type'], $imageKind)) {
            $type = explode(".", $_FILES['upload']['name'])[1];
			if (move_uploaded_file ($_FILES['upload']['tmp_name'], $image_storage.$name.$year.".".$type)) {
//                unlink($image_storage.$filename);
                $URI = $image_storage.$name.$year.".".$type;

                if($gyear != -1)
                    $ret = mysql_query("update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, GRADUATE_YEAR=$gyear, DEGREE=$degree, PROFILE_PHOTO_URI='$URI', DESCP='$desc' where `STUDENT_ID` = $id",$conn);
                else
                    $ret = mysql_query("update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, GRADUATE_YEAR=NULL, DEGREE=$degree, PROFILE_PHOTO_URI='$URI', DESCP='$desc' where `STUDENT_ID` = $id",$conn);
                echo "<script>alert('".$year.$degree."complete');window.location = 'index.php';</script>";

			}

		} else {
			echo "<script>alert('JPEG 또는 PNG 이미지만 업로드 가능합니다.')</script>";
		}

	}

	if ($_FILES['upload']['error'] > 0) {

		switch ($_FILES['upload']['error']) {
			case 1:
				$error = 'php.ini 파일의 upload_max_filesize 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 2:
				$error = 'Form에서 설정된 MAX_FILE_SIZE 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 3:
				$error = '파일 일부만 업로드 됨';
				break;
			case 4:
                if($gyear != -1)
                    $ret = mysql_query("update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, GRADUATE_YEAR=$gyear, DEGREE=$degree, PROFILE_PHOTO_URI='$filename', DESCP='$desc' where `STUDENT_ID` = $id",$conn);
                else
                    $ret = mysql_query("update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, GRADUATE_YEAR=NULL, DEGREE=$degree, PROFILE_PHOTO_URI='$filename', DESCP='$desc' where `STUDENT_ID` = $id",$conn);
                echo "<script>alert('".$year.$degree."complete');window.location = 'index.php';</script>";
				break;
			case 6:
				$error = '사용가능한 임시폴더가 없음';
				break;
			case 7:
				$error = '디스크에 저장할수 없음';
				break;
			case 8:
				$error = '파일 업로드가 중지됨';
				break;
			default:
				$error = '시스템 오류가 발생';
				break;
		}
		echo "<script>alert('파일 업로드 실패 이유: ".$error."')</script>";

	}

	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
		unlink ($_FILES['upload']['tmp_name']);
	}

}


?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>image upload test</title>
</head>
<body>

<form enctype="multipart/form-data" action="" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="5242888">

	<fieldset><legend>업로드할 사진파일(JPG,PNG)을 선택하세요(5mb이내):</legend>

	<p><b>파일:</b> <input type="file" name="upload" /></p>

	</fieldset>


    <p>
        <label for="name">이름</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>">
    </p>
    <p>
        <label for="number">학번</label>
        <input type="text" name="number" id="number" placeholder="ID" value="<?php echo $number; ?>">
    </p>
    <p>
        <label for="year">입학년도</label>
        <select name="year" id="year">
            <option value="-1">선택해 주십시오.</option>
            <?php
                for($i=date("Y");$i>1950;$i--) {
                    if($i != $year)
                        echo "<option value='{$i}'>{$i}</option>";
                    else
                        echo "<option value='{$i}' selected>{$i}</option>";
                }
            ?>
        </select>
    </p>
    <p>
        <label for="gyear">졸업년도</label>
        <select name="gyear" id="gyear">
            <option value="-1">졸업하지 않음.</option>
            <?php
                for($i=date("Y");$i>1950;$i--) {
                    if($i != $gyear)
                        echo "<option value='{$i}'>{$i}</option>";
                    else
                        echo "<option value='{$i}' selected>{$i}</option>";
                }
            ?>
        </select>
    </p>
    <p>
        <label for="degree">학위</label>
        <select name="degree" id="degree">
            <option value="-1">선택해 주십시오.</option>
            <option value='0' <?php if($degree == 0) echo "selected";?>>연구교수</option>
            <option value='1' <?php if($degree == 1) echo "selected";?>>박사 과정 재학</option>
            <option value='2' <?php if($degree == 2) echo "selected";?>>박사 졸업</option>
            <option value='3' <?php if($degree == 3) echo "selected";?>>석사 과정 재학</option>
            <option value='4' <?php if($degree == 4) echo "selected";?>>석사 졸업</option>
            <option value='6' <?php if($degree == 6) echo "selected";?>>석박통합과정 재학</option>
            <option value='5' <?php if($degree == 5) echo "selected";?>>인턴 | 학부연구생</option>

        </select>
    </p>
    <p>
        <label for="desc">자기소개</label>
        <textarea name="desc" id="desc" placeholder="DESCRIPTION"><?php echo $desc;?></textarea>

    </p>

	<div align="center"><input type="submit" name="upload_form" value="업로드" /></div>



	<input type="hidden" name="upload_check" value="true" />
</form>
</body>
</html>
