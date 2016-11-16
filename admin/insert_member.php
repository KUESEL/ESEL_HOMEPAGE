<?php include("session.php") ?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>image upload test</title>
</head>
<body>
<?php
include('config.php');
if($_SERVER['REQUEST_METHOD']=='POST') {
if(isset($_POST['name'])&&isset($_POST['number'])&&isset($_POST['year'])&&isset($_POST['degree'])&&isset($_POST['desc'])&&($_POST['email']!=NULL)){
    $name = $_POST['name'];
    $year = $_POST['year'];
    $degree = $_POST['degree'];
    $desc = $_POST['desc'];
    $gyear = $_POST['gyear'];
    $id = $_POST['number'];
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
                    $URI = $image_storage.$name.$year.".".$type;
                    $q = "insert into `members` (STUDENT_NAME, STUDENT_NUMBER, ADMISSION_YEAR, DEGREE, PROFILE_PHOTO_URI, DESCP, EMAIL";
                    $v = ") values('$name', '$id', $year, $degree, '$URI', '$desc', '$email'";

                    if($gyear != -1){
                        $q = $q.", GRADUATE_YEAR";
                        $v = $v.", $gyear";
                    }
                    if($linkedin != NULL){
                        $q = $q.", LINKED_IN_URL";
                        $v = $v.", '$linkedin'";
                    }
                    if($fb != NULL){
                        $q = $q.", FACEBOOK_URL";
                        $v = $v.", '$fb'";
                    }
                    if($tw != NULL){
                        $q = $q.", TWITTER_URL";
                        $v = $v.", '$tw'";
                    }
                    if($insta != NULL){
                        $q = $q.", INSTAGRAM_URL";
                        $v = $v.", '$insta'";
                    }
                    if($blog != NULL){
                        $q = $q.", BLOG_URL";
                        $v = $v.", '$blog'";
                    }

                    $query = $q.$v.")";
                    $ret = mysql_query($query, $conn);
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
}
else{
    echo "<script>alert('양식을 정확히 입력')</script>";

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
            <option value="-1" selected disabled>선택해 주십시오.</option>
            <option value='0'>연구교수</option>
            <option value='1'>박사 재학</option>
            <option value='2'>박사 졸업</option>
            <option value='3'>석사 재학</option>
            <option value='4'>석사 졸업</option>
            <option value='6'>석박 통합과정 재학</option>
            <option value='5'>인턴 | 학부연구생</option>
        </select>
    </p>
    <p>
        <label for="desc">자기소개</label>
        <textarea name="desc" id="desc" placeholder="DESCRIPTION"></textarea>

    </p>

    <br/>
    <p>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" placeholder="E-mail url">
    </p>
    <p>
        <label for="linkedin">LinkedIn</label>
        <input type="text" name="linkedin" id="linkedin" placeholder="LinkedIn url">
    </p>
    <p>
        <label for="facebook">Facebook</label>
        <input type="text" name="facebook" id="facebook" placeholder="Facebook url">
    </p>
    <p>
        <label for="twit">Twitter</label>
        <input type="text" name="twit" id="twit" placeholder="Twitter url">
    </p>
    <p>
        <label for="insta">Instagram</label>
        <input type="text" name="insta" id="insta" placeholder="Instagram url">
    </p>
    <p>
        <label for="blog">Blog</label>
        <input type="text" name="blog" id="blog" placeholder="Blog url">
    </p>



    <div align="center"><input type="submit" name="upload_form" value="업로드" /></div>



	<input type="hidden" name="upload_check" value="true" />
</form>
</body>
</html>
