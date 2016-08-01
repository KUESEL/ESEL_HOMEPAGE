<?php
        include("config.php");

if($_SERVER['REQUEST_METHOD']=='POST') {

    $act = $_POST['act'];
    if ($act == 1){
        $id = $_POST['id'];
        $row = mysql_fetch_array(mysql_query("select ARTICLE_THUMBNAIL_URI from articles where ARTICLE_ID = $id",$conn));
        $filename = $row['ARTICLE_THUMBNAIL_URI'];
    }
    
    $title = $_POST['title'];
    $link = $_POST['link'];
    $desc = $_POST['desc'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
        
       if (isset($_POST['upload_check'])) {
            if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

                $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

                if (in_array($_FILES['upload']['type'], $imageKind)) {
                    $type = explode(".", $_FILES['upload']['name'])[1];
                    if (move_uploaded_file ($_FILES['upload']['tmp_name'], $article_storage.md5($title.$year).".".$type)) {
                        $URI = $article_storage.md5($title.$year).".".$type;
                        
                        if($act == 1){
                            $query = "update `articles` set ARTICLE_TITLE='$title', ARTICLE_URL='$link', ARTICLE_PUBLISHED_YEAR=$year, ARTICLE_PUBLISHED_MONTH=$month, ARTICLE_PUBLISHED_DAY=$day, ARTICLE_THUMBNAIL_URI='$URI', ARTICLE_SUMMARY='$desc'";
                            $query = $query." where `ARTICLE_ID` = $id";
                            $ret = mysql_query($query,$conn);
                            if($ret){
                                echo "<script>alert('".$title." complete');window.location = 'articles_list.php';</script>";
                            }
                        }
                        else{
                            $q = "insert into `articles` (ARTICLE_TITLE, ARTICLE_URL, ARTICLE_PUBLISHED_YEAR, ARTICLE_PUBLISHED_MONTH, ARTICLE_PUBLISHED_DAY, ARTICLE_THUMBNAIL_URI, ARTICLE_SUMMARY";
                            $v = ") values('$title', '$link', $year, $month, $day, '$URI', '$desc'";
                            $query = $q.$v.")";
                            $ret = mysql_query($query, $conn);
                            if($ret){
                                echo "<script>alert('".$title." complete');window.location = 'articles_list.php';</script>";
                            }
                            else{
                                echo $conn;
                            }
                        }

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
                        if($act == 1){
                            $query = "update `articles` set ARTICLE_TITLE='$title', ARTICLE_URL='$link', ARTICLE_PUBLISHED_YEAR=$year, ARTICLE_PUBLISHED_MONTH=$month, ARTICLE_PUBLISHED_DAY=$day, ARTICLE_THUMBNAIL_URI='$filename', ARTICLE_SUMMARY='$desc'";

                            $query = $query." where `ARTICLE_ID` = $id";
                            $ret = mysql_query($query,$conn);
                            if($ret){
                                echo "<script>alert('".$title." complete');window.location = 'articles_list.php';</script>";
                            }
                        }
                        else{
                            $error = '업로드된 파일이 없음';
                        }
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
?>