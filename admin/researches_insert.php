<?php
        include("config.php");

if($_SERVER['REQUEST_METHOD']=='POST') {

    $act = $_POST['act'];
    if ($act == 1){
        $id = $_POST['id'];
        $row = mysql_fetch_array(mysql_query("select RESEARCH_PICT_URI from researches where RESEARCH_ID = $id",$conn));
        $filename = $row['RESEARCH_PICT_URI'];
    }
    if(isset($_POST['name'])&&isset($_POST['desc'])&&isset($_POST['degree'])){
        $name = $_POST['name'];
        $degree = $_POST['degree'];
        $desc = $_POST['desc'];
        $sponser = $_POST['sponser'];
        $term = $_POST['term'];
        
       if (isset($_POST['upload_check'])) {
            if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

                $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

                if (in_array($_FILES['upload']['type'], $imageKind)) {
                    $type = explode(".", $_FILES['upload']['name'])[1];
                    if (move_uploaded_file ($_FILES['upload']['tmp_name'], $research_storage.md5($name).".".$type)) {
                        $URI = $research_storage.md5($name).".".$type;
                        
                        if($act == 1){
                            $query = "update `researches` set RESEARCH_TOPIC='$name', RESEARCH_CATEGORY=$degree, RESEARCH_PICT_URI='$URI', RESEARCH_DESC='$desc', RESEARCH_SPONSER='$sponser', RESEARCH_TERM='$term' where `RESEARCH_ID` = $id";
                            $ret = mysql_query($query,$conn);
                            if($ret){
                                echo "<script>alert('".$name.$degree."complete');window.location = 'researches_list.php';</script>";
                            }
                        }
                        else{
                            $q = "insert into `researches` (RESEARCH_TOPIC, RESEARCH_CATEGORY, RESEARCH_PICT_URI, RESEARCH_DESC, RESEARCH_SPONSER, RESEARCH_TERM";
                            $v = ") values('$name', $degree, '$URI', '$desc', '$sponser', '$term'";
                            $query = $q.$v.")";
                            $ret = mysql_query($query, $conn);
                            if($ret){
                                echo "<script>alert('".$name.$degree."complete');window.location = 'researches_list.php';</script>";
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
                        $query = "update `researches` set RESEARCH_TOPIC='$name', RESEARCH_CATEGORY=$degree, RESEARCH_PICT_URI='$URI', RESEARCH_DESC='$desc', RESEARCH_SPONSER='$sponser', RESEARCH_TERM='$term' where `RESEARCH_ID` = $id";

                        $ret = mysql_query($query,$conn);
                        if($ret)
                            echo "<script>alert('".$name.$degree."complete');window.location = 'researches_list.php';</script>";
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
    else{
        echo "<script>alert('양식을 정확히 입력')</script>";

    }
}
?>