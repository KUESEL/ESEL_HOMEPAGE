<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>image upload test</title>
</head>
<body>
<?php
include('config.php');
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $year = $_POST['year'];
    $degree = $_POST['degree'];
    $desc = $_POST['desc'];
    $gyear = $_POST['gyear'];
    $id = $_POST['number'];
}
if (isset($_POST['upload_check'])) {

	if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		if (in_array($_FILES['upload']['type'], $imageKind)) {
            $type = explode(".", $_FILES['upload']['name'])[1];
			if (move_uploaded_file ($_FILES['upload']['tmp_name'], $image_storage.$name.$year.".".$type)) {
                $URI = $image_storage.$name.$year.".".$type;
                if($gyear == -1)
                    $ret = mysql_query("insert into `members` (STUDENT_NAME, STUDENT_NUMBER, ADMISSION_YEAR, DEGREE, PROFILE_PHOTO_URI, DESCP) values('$name', '$id', $year, $degree, '$URI', '$desc')",$conn);
                else
                    $ret = mysql_query("insert into `members` (STUDENT_NAME, STUDENT_NUMBER, ADMISSION_YEAR, GRADUATE_YEAR, DEGREE, PROFILE_PHOTO_URI, DESCP) values('$name', '$id', $year, $gyear, $degree, '$URI', '$desc')",$conn);
                if($ret){
                echo "<script>alert('".$year.$degree."complete');window.location = 'index.php';</script>";
                }
                else{
                    echo $conn;
                }
			}
			
		} else {
			echo "<script>alert('JPEG 또는 PNG 이미지만 업로드 가능합니다.')</script>";
		}

	}

	if ($_FILES['upload']['error'] > 0) {
		echo "<script>alert('파일 업로드 실패 이유: ";
	
		switch ($_FILES['upload']['error']) {
			case 1:
				echo 'php.ini 파일의 upload_max_filesize 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 2:
				echo 'Form에서 설정된 MAX_FILE_SIZE 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 3:
				echo '파일 일부만 업로드 됨';
				break;
			case 4:
				echo '업로드된 파일이 없음';
				break;
			case 6:
				echo '사용가능한 임시폴더가 없음';
				break;
			case 7:
				echo '디스크에 저장할수 없음';
				break;
			case 8:
				echo '파일 업로드가 중지됨';
				break;
			default:
				echo '시스템 오류가 발생';
				break;
		}
		
		echo "')</script>";
		
	}
	
	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
		unlink ($_FILES['upload']['tmp_name']);
	}
    
}
?>
	
<form enctype="multipart/form-data" action="" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="5242888">
	
	<fieldset><legend>업로드할 사진파일(JPG,PNG)을 선택하세요(5mb이내):</legend>
	
	<p><b>파일:</b> <input type="file" name="upload" /></p>
	
	</fieldset>

    
    <p>
        <label for="name">이름</label>
        <input type="text" name="name" id="name" placeholder="Name">
    </p>
    <p>
        <label for="number">학번</label>
        <input type="text" name="number" id="number" placeholder="ID">
    </p>
    <p>
        <label for="year">입학년도</label>
        <select name="year" id="year">
            <option value="-1" selected>선택해 주십시오.</option>
            <?php
                for($i=date("Y");$i>1960;$i--) {
                    echo "<option value='{$i}'>{$i}</option>";
                }
            ?>
        </select>
    </p>
    <p>
        <label for="gyear">졸업년도</label>
        <select name="gyear" id="gyear">
            <option value="-1" selected>졸업하지 않음.</option>
            <?php
                for($i=date("Y");$i>1960;$i--) {
                    echo "<option value='{$i}'>{$i}</option>";
                }
            ?>
        </select>
    </p>
    <p>
        <label for="degree">학위</label>
        <select name="degree" id="degree">
            <option value="-1" selected>선택해 주십시오.</option>
            <option value='0'>연구교수</option>
            <option value='1'>박사 재학</option>
            <option value='2'>박사 졸업</option>
            <option value='3'>석사 재학</option>
            <option value='4'>석사 졸업</option>
            <option value='5'>인턴 | 학부연구생</option>
        </select>
    </p>
    <p>
        <label for="desc">자기소개</label>
        <textarea name="desc" id="desc" placeholder="DESCRIPTION"></textarea>

    </p>
	<div align="center"><input type="submit" name="upload_form" value="업로드" /></div>
    
    
    
	<input type="hidden" name="upload_check" value="true" />
</form>
</body>
</html>