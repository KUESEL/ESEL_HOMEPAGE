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
        $email = $row['EMAIL'];
        $linkedin = $row['LINKED_IN_URL'];
        $fb = $row['FACEBOOK_URL'];
        $tw = $row['TWITTER_URL'];
        $insta = $row['INSTAGRAM_URL'];
        $blog = $row['BLOG_URL'];
    }


if($_SERVER['REQUEST_METHOD']=='POST') {

    if(isset($_POST['name'])&&isset($_POST['number'])&&isset($_POST['year'])&&isset($_POST['degree'])&&isset($_POST['desc'])&&($_POST['email']!=NULL)){
        $name = $_POST['name'];
        $year = $_POST['year'];
        $degree = $_POST['degree'];
        $desc = $_POST['desc'];
        $gyear = $_POST['gyear'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $linkedin = $_POST['linkedin'];
        $fb = $_POST['facebook'];
        $tw = $_POST['twit'];
        $insta = $_POST['insta'];
        $blog = $_POST['blog'];

        if (isset($_POST['upload_check'])) {

            if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

                $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

                if (in_array($_FILES['upload']['type'], $imageKind)) {
                    $type = explode(".", $_FILES['upload']['name'])[1];
                    if (move_uploaded_file ($_FILES['upload']['tmp_name'], $image_storage.$name.$year.".".$type)) {
        //                unlink($image_storage.$filename);
                        $URI = $image_storage.$name.$year.".".$type;
                        $query = "update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, DEGREE=$degree, PROFILE_PHOTO_URI='$URI', DESCP='$desc'";

                        if($gyear != -1)
                            $query = $query.", GRADUATE_YEAR=$gyear";
                        else
                            $query = $query.", GRADUATE_YEAR=NULL";

                        if($linkedin != NULL)
                            $query = $query.", LINKED_IN_URL='$linkedin'";
                        else
                            $query = $query.", LINKED_IN_URL=NULL";
                        if($fb != NULL)
                            $query = $query.", FACEBOOK_URL='$fb'";
                        else
                            $query = $query.", FACEBOOK_URL=NULL";
                        if($tw != NULL)
                            $query = $query.", TWITTER_URL='$tw'";
                        else
                            $query = $query.", TWITTER_URL=NULL";
                        if($insta != NULL)
                            $query = $query.", INSTAGRAM_URL='$insta'";
                        else
                            $query = $query.", INSTAGRAM_URL=NULL";
                        if($blog != NULL)
                            $query = $query.", BLOG_URL='$blog'";
                        else
                            $query = $query.", BLOG_URL=NULL";



                        $query = $query." where `STUDENT_ID` = $id";
                        $ret = mysql_query($query,$conn);
                        if($ret)
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
                        $query = "update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, DEGREE=$degree, PROFILE_PHOTO_URI='$filename', DESCP='$desc'";

                        if($gyear != -1)
                            $query = $query.", GRADUATE_YEAR=$gyear";
                        else
                            $query = $query.", GRADUATE_YEAR=NULL";

                        if($linkedin != NULL)
                            $query = $query.", LINKED_IN_URL='$linkedin'";
                        else
                            $query = $query.", LINKED_IN_URL=NULL";
                        if($fb != NULL)
                            $query = $query.", FACEBOOK_URL='$fb'";
                        else
                            $query = $query.", FACEBOOK_URL=NULL";
                        if($tw != NULL)
                            $query = $query.", TWITTER_URL='$tw'";
                        else
                            $query = $query.", TWITTER_URL=NULL";
                        if($insta != NULL)
                            $query = $query.", INSTAGRAM_URL='$insta'";
                        else
                            $query = $query.", INSTAGRAM_URL=NULL";
                        if($blog != NULL)
                            $query = $query.", BLOG_URL='$blog'";
                        else
                            $query = $query.", BLOG_URL=NULL";



                        $query = $query." where `STUDENT_ID` = $id";

                        $ret = mysql_query($query,$conn);
                        if($ret)
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
    }
    else{
        echo "<script>alert('양식을 정확히 입력')</script>";

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
    <p>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" placeholder="E-mail url" value="<?php echo $email;?>">
    </p>
    <p>
        <label for="linkedin">LinkedIn</label>
        <input type="text" name="linkedin" id="linkedin" placeholder="LinkedIn url" value="<?php echo $linkedin;?>">
    </p>
    <p>
        <label for="facebook">Facebook</label>
        <input type="text" name="facebook" id="facebook" placeholder="Facebook url" value="<?php echo $fb;?>">
    </p>
    <p>
        <label for="twit">Twitter</label>
        <input type="text" name="twit" id="twit" placeholder="Twitter url" value="<?php echo $tw;?>">
    </p>
    <p>
        <label for="insta">Instagram</label>
        <input type="text" name="insta" id="insta" placeholder="Instagram url" value="<?php echo $insta;?>">
    </p>
    <p>
        <label for="blog">Blog</label>
        <input type="text" name="blog" id="blog" placeholder="Blog url" value="<?php echo $blog;?>">
    </p>

	<div align="center"><input type="submit" name="upload_form" value="업로드" /></div>
    
    
    
	<input type="hidden" name="upload_check" value="true" />
</form>
</body>
</html>