<?php
        include("config.php");

if($_SERVER['REQUEST_METHOD']=='POST') {

    $act = $_POST['act'];
    $skill1 = $_POST['skill1_name'];
    $value1 = $_POST['skill1_val'];
    $skill2 = $_POST['skill2_name'];
    $value2 = $_POST['skill2_val'];
    $skill3 = $_POST['skill3_name'];
    $value3 = $_POST['skill3_val'];
    $skill4 = $_POST['skill4_name'];
    $value4 = $_POST['skill4_val'];
    if ($act == 1){
        $id = $_POST['id'];
        $row = mysql_fetch_array(mysql_query("select PROFILE_PHOTO_URI from members where STUDENT_ID = $id",$conn));
        $filename = $row['PROFILE_PHOTO_URI'];
        if (mysql_num_rows(mysql_query("select * from skills where STUDENT_ID = $id"))!=0){
            $query = "delete from skills where `STUDENT_ID` = $id";
            mysql_query($query, $conn);
            $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill1', $value1)",$conn);
            $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill2', $value2)",$conn);
            $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill3', $value3)",$conn);
            $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill4', $value4)",$conn);
        }
    }
    if(isset($_POST['name'])&&isset($_POST['number'])&&isset($_POST['year'])&&isset($_POST['degree'])&&isset($_POST['desc'])&&($_POST['email']!=NULL)){
        $name = $_POST['name'];
        $name2 = $_POST['name2'];
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
                    if (move_uploaded_file ($_FILES['upload']['tmp_name'], $image_storage.md5($name.$year).".".$type)) {
        //                unlink($image_storage.$filename);
                        $URI = $image_storage.md5($name.$year).".".$type;
                        
                        if($act == 1){
                            $query = "update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, DEGREE=$degree, PROFILE_PHOTO_URI='$URI', DESCP='$desc', EMAIL='$email'";

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
                            if($name2 != NULL)
                                $query = $query.", STUDENT_NAME_ENG='$name2'";
                            else
                                $query = $query.", STUDENT_NAME_ENG=NULL";
                                


                            $query = $query." where `STUDENT_ID` = $id";
                            $ret = mysql_query($query,$conn);
                            if($ret){
                                echo "<script>alert('".$year.$degree."complete');window.location = 'members_list.php';</script>";
                            }
                        }
                        else{
                            $q = "insert into `members` (STUDENT_NAME, STUDENT_NUMBER, ADMISSION_YEAR, DEGREE, PROFILE_PHOTO_URI, DESCP, EMAIL";
                            $v = ") values('$name', '$number', $year, $degree, '$URI', '$desc', '$email'";

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
                            if($name2 != NULL){
                                $q = $q.", STUDENT_NAME_ENG";
                                $v = $v.", '$name2'";                                                                                
                            }

                            $query = $q.$v.")";
                            $ret = mysql_query($query, $conn);
                            if($ret){
                                $max = mysql_fetch_array(mysql_query("select max(STUDENT_ID) from members", $conn));
                                $id = $max[0];
                                $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill1', $value1)",$conn);
                                $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill2', $value2)",$conn);
                                $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill3', $value3)",$conn);
                                $ret = mysql_query("insert into skills (STUDENT_ID, SKILL_NAME, SKILL_SCORE) values($id, '$skill4', $value4)",$conn);
                                echo "<script>alert('".$year.$degree."complete');window.location = 'members_list.php';</script>";
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
                        $query = "update `members` set STUDENT_NAME='$name', STUDENT_NUMBER='$number', ADMISSION_YEAR=$year, DEGREE=$degree, PROFILE_PHOTO_URI='$filename', DESCP='$desc', EMAIL='$email'";

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
                        if($name2 != NULL)
                            $query = $query.", STUDENT_NAME_ENG='$name2'";
                        else
                            $query = $query.", STUDENT_NAME_ENG=NULL";



                        $query = $query." where `STUDENT_ID` = $id";

                        $ret = mysql_query($query,$conn);
                        if($ret)
                            echo "<script>alert('".$year.$degree."complete');window.location = 'members_list.php';</script>";
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