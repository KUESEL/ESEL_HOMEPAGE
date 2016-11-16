<?php include("session.php") ?>
<?php
        include("config.php");

if($_SERVER['REQUEST_METHOD']=='POST') {

    $act = mysql_real_escape_string($_POST['act']);
    $title = mysql_real_escape_string($_POST['title']);
    $desc = mysql_real_escape_string($_POST['desc']);
    $loc = mysql_real_escape_string($_POST['location']);
    if ($act == 1){
        $id = mysql_real_escape_string($_POST['id']);
        $ret = mysql_query("update `photos` set PHOTO_TITLE='$title', PHOTO_DESC='$desc', PHOTO_PLACE='$loc' where `PHOTO_ID` = $id",$conn);
        echo "<script>alert('Complete');window.location = 'photos_list.php';</script>";
    }
    else if(isset($_POST['title'])){
        if (isset($_POST['upload_check'])) {

            if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

                $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

                if (in_array($_FILES['upload']['type'], $imageKind)) {
                    $type = explode(".", $_FILES['upload']['name'])[1];
                    $URI = "$image_storage"."esel_".md5($title.$loc).".".$type;
                    if (move_uploaded_file ($_FILES['upload']['tmp_name'], $URI)) {
                        $ret = mysql_query("insert into `photos` (PHOTO_URI, PHOTO_TITLE, PHOTO_DESC, PHOTO_PLACE) values('$URI', '$title', '$desc', '$loc')",$conn);
                        if($ret){
                        echo "<script>alert('Complete');window.location = 'photos_list.php';</script>";
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
