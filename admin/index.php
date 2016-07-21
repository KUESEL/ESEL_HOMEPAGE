<?php
    include("config.php");
    $image_storage = "./gallery/";
    $query = "select * from thesis";
    if (array_key_exists("search_keyword", $_POST)) {
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where title like '%$search_keyword%' or lead_author like '%$search_keyword%' or year like '%$search_keyword%'";
    }
    $res = mysql_query($query, $conn);
    if (!$res) {
        die('Query Error : ' . mysql_error());
    }
    $ret = mysql_query("select * from photos ORDER BY CREATED_AT", $conn);
    
if(isset($_POST['title'])){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $loc = $_POST['location'];
}
if (isset($_POST['upload_check'])) {

    if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

        $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

        if (in_array($_FILES['upload']['type'], $imageKind)) {
            $type = explode(".", $_FILES['upload']['name'])[1];
            if (move_uploaded_file ($_FILES['upload']['tmp_name'], $image_storage.$title.$loc.".".$type)) {
                $URI = $image_storage.$title.$loc.".".$type;
                $ret = mysql_query("insert into `photos` (PHOTO_URI, PHOTO_TITLE, PHOTO_DESC, PHOTO_PLACE) values('$URI', '$title', '$desc', '$loc')",$conn);
                if($ret){
                echo "<script>alert('Complete');window.location = 'index.php';</script>";
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
<!DOCTYPE html>
<html lang='ko'>
    <head>
        <title>Test page for server-side</title>
        <meta charset="UTF-8">
    </head>

    <body>
        
<script>
function openNewWindow(url) {
  var name = '_blank';
  var specs = 'width=460px,height=573px,scrollbars=yes,menubar=no,status=no,toolbar=no';
  var newWindow = window.open(url, name, specs);
  newWindow.focus();
}

function getReturnValue(returnValue) {
document.getElementById("lead_author").value = returnValue;
}
        
</script>
        <fieldset><legend>멤버</legend>
        <input type="button" onclick="window.location = 'insert_member.php'" value="추가"/>
        <table border="1">
            <thead>
            <tr>
                <th>Index</th>
                <th>Image</th>
                <th>Name</th>
                <th>ID</th>
                <th>Year</th>
                <th>Degree</th>
                <th>ETC</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $row_index = 1;
                    $re = mysql_query("select * from members");
                    while ($row = mysql_fetch_array($re)) {
                        echo "<tr>";
                        echo "<td>{$row_index}</td>";
                        $file = $row['PROFILE_PHOTO_URI'];
                        echo "<td><img src='{$file}' width='80px' height='80px'/></td>";
                        echo "<td>{$row['STUDENT_NAME']}</td>";
                        echo "<td>{$row['STUDENT_NUMBER']}</td>";
                        echo "<td>{$row['ADMISSION_YEAR']}</td>";
                        switch($row['DEGREE']){
                                        case 0 : $degree = "연구교수"; break;
                                        case 1 : $degree = "박사 재학"; break;
                                        case 2 : $degree = "박사 졸업"; break;
                                        case 3 : $degree = "석사 재학"; break;
                                        case 4 : $degree = "석사 졸업"; break;
                                        case 5 : $degree = "인턴|학부연구생"; break;
                                        default : $degree = ""; break;
                        }
                        echo "<td>{$degree}</td>";
                ?>
                        <td width='17%'>
                            <input type='button' value='삭제' onclick="window.location = 'delete_member.php?id=<?php echo $row['STUDENT_ID'];?>'"/>
                            <input type='button' value='수정' onclick="window.location = 'modify_member.php?id=<?php echo $row['STUDENT_ID'];?>'"/>
                        </td>
                <?php
                        echo "</tr>";
                        $row_index++;
                    }
                ?>
            </tbody>
        </table>        
        </fieldset>        
        
        <fieldset><legend>논문 등록</legend>
	
	
	
	    <form enctype="multipart/form-data" action="insert_thesis.php" method="post">
            <p>
                <label for="title">제목</label>
                <input type="text" name="title" id="title" placeholder="Title of thesis">
            </p>
            <p>
                <label for="cate">카테고리</label>
                <select name="cate" id="cate">
                    <option value="-1" disabled selected>선택해 주십시오.</option>
                    <option value="0">국제 학술지</option>
                    <option value="1">국내 학술지</option>
                    <option value="2">국제 컨퍼런스</option>
                    <option value="3">국내 컨퍼런스</option>
                    <option value="4">특허</option>
                </select>
            </p>
            <p>
                <label for="lead_author">주 저자</label>
                <input type="text" name="lead_author" id="lead_author" value=""  readonly="readonly"/>
                <input type="button" value="검색" onClick="openNewWindow('search_member.php');"/>
            </p>
            <p>
                <label for="co_author">공동저자(','로 구분)</label>
                <input type="text" name="co_author" id="co_author" value=""/>
            </p>
            <p>
                <label for="journal">학회(','로 구분)</label>
                <input type="text" name="journal" id="journal" value=""/>
            </p>
            <p>
                <label for="abstract">초록</label>
                <textarea name="abstract" id="abstract" placeholder="Abstract of thesis"></textarea>
            </p>
            <p>
                <label for="year">년도</label>
                <select name="year" id="year">
                    <option value="-1" selected>선택해 주십시오.</option>
                    <?php
                        for($i=1900;$i<date("Y");$i++) {
                            echo "<option value='{$i}'>{$i}</option>";
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="link">FULL TEXT 링크</label>
                <input type="text" name="link" id="link" value=""/>
            </p>

            <input type="submit" value="등록"/>
        </form>
        </fieldset>
    

        <form enctype="multipart/form-data" action="" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="5242888">

            <fieldset><legend>Gallery</legend>

            <p><b>파일:</b> <input type="file" name="upload" /></p>
            <p>
                <label for="title">제목</label>
                <input type="text" name="title" id="title" placeholder="Title">
            </p>
            <p>
                <label for="desc">설명</label>
                <textarea name="desc" id="desc" placeholder="DESCRIPTION"></textarea>

            </p>
            <p>
                <label for="location">장소</label>
                <input type="text" name="location" id="location" placeholder="Loaction">
            </p>
            
                <input type="submit" name="upload_form" value="업로드" />

            </fieldset>





            <input type="hidden" name="upload_check" value="true" />
        </form>
        <fieldset><legend>Gallery</legend>
        <?php
            while($pic = mysql_fetch_array($ret)){
        ?>
                <div style="height: auto; max-height: 250px; max-width: 250px;overflow: auto;">
                    <img src="<?php echo $pic['PHOTO_URI'];?>" style="width:100%; height:100%;"/>
                        <div align="center">
                            <input type='button' value='수정' onclick="window.location = 'modify_photo.php?id=<?php echo $pic['PHOTO_ID'];?>'"/>
                            <input type='button' value='삭제' onclick="window.location = 'delete_photo.php?id=<?php echo $pic['PHOTO_ID'];?>'"/>

                        </div>
                </div>
        <?php
            }
        ?>
        </fieldset>
        
        
        <fieldset><legend>Member Skills</legend>
	
	
	<!--
	    <form enctype="multipart/form-data" action="insert_thesis.php" method="post">

            <p>
                <label for="title">제목</label>
                <input type="text" name="title" id="title" placeholder="Title of thesis">
            </p>

            <input type="submit" value="등록"/>
        </form>
    -->
        </fieldset>        
        <br>
        <br>
        <br>

        

        
        
        
        <fieldset><legend>논문 목록</legend>
        <table border="1">
            <thead>
            <tr>
                <th>Index</th>
                <th>Title</th>
                <th>Lead_author</th>
                <th>Year</th>
                <th>File</th>
                <th>Upload Date</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $row_index = 1;
                    while ($row = mysql_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>{$row_index}</td>";
                        echo "<td><a href='detail_thesis.php?id={$row['index']}'>{$row['title']}</a></td>";
                        echo "<td>{$row['lead_author']}</td>";
                        echo "<td>{$row['year']}</td>";
                        if($row['upload']==1)
                            echo "<td>exists</td>";
                        else
                            echo "<td>no</td>";
                        echo "<td width='17%'>{$row['date']}</td>";
                        echo "</tr>";
                        $row_index++;
                    }
                ?>
            </tbody>
        </table>
        </fieldset>
        <!--
        <form action="index.php" method="post">
            <p>검색<input type="text" name="search_keyword" placeholder="제목/저자/년도" width="300px"></p>
        </form>
        -->
        <br>
        <br>
        <br>

    </body>
</html>