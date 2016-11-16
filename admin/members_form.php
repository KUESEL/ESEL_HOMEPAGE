<?php include("session.php") ?>
<!DOCTYPE html>
<?php
    include("config.php");
    $act = 0;
    if (array_key_exists("id", $_GET)) {
        $act = 1;
        $id = $_GET["id"];
        $res = mysql_query("select * from members where STUDENT_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $name = $row['STUDENT_NAME'];
        $name2 = $row['STUDENT_NAME_ENG'];
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
        $query = "select * from skills where STUDENT_ID=$id order by SKILL_ID";
        $ret = mysql_query($query, $conn);
        while($s = mysql_fetch_array($ret)){
            $skill[] = $s;
        }

    }
?>

<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    <link href="http://fonts.googleapis.com/earlyaccess/nanumpenscript.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../style.css" type="text/css" />
	<link rel="stylesheet" href="../css/dark.css" type="text/css" />
	<link rel="stylesheet" href="../css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="../css/animate.css" type="text/css" />
	<link rel="stylesheet" href="../css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="../css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
    <script src="js/jquery-3.0.0.min.js"></script>

	<!-- Document Title
	============================================= -->
    <?php if($act == 0){?>
	<title>Member Register</title>
    <?php }else{ ?>
	<title>Member Edit</title>
    <?php }?>
</head>

<body class="stretched">
<script>
$(document).ready(function(){
    var $pc1 = $('#progressController1');
    $pc1.on('change', function(){
        var percentage = $(this).val();
        document.getElementById("skill1_val").value = percentage;
    });

    var $pc2 = $('#progressController2');
    $pc2.on('change', function(){
        var percentage = $(this).val();
        document.getElementById("skill2_val").value = percentage;
    });

    var $pc3 = $('#progressController3');
    $pc3.on('change', function(){
        var percentage = $(this).val();
        document.getElementById("skill3_val").value = percentage;
    });

    var $pc4 = $('#progressController4');
    $pc4.on('change', function(){
        var percentage = $(this).val();
        document.getElementById("skill4_val").value = percentage;
    });

    var $v1 = $('#skill1_val');
    $v1.on('change', function(){
        var percentage = $(this).val();
        if (percentage>100){
            percentage = 100;
            document.getElementById("skill1_val").value = percentage;
        }
        document.getElementById("progressController1").value = percentage;
    });

    var $v2 = $('#skill2_val');
    $v2.on('change', function(){
        var percentage = $(this).val();
        if (percentage>100){
            percentage = 100;
            document.getElementById("skill2_val").value = percentage;
        }
        document.getElementById("progressController2").value = percentage;
    });

    var $v3 = $('#skill3_val');
    $v3.on('change', function(){
        var percentage = $(this).val();
        if (percentage>100){
            percentage = 100;
            document.getElementById("skill3_val").value = percentage;
        }
        document.getElementById("progressController3").value = percentage;
    });

    var $v4 = $('#skill4_val');
    $v4.on('change', function(){
        var percentage = $(this).val();
        if (percentage>100){
            percentage = 100;
            document.getElementById("skill4_val").value = percentage;
        }
        document.getElementById("progressController4").value = percentage;
    });


});
function validateForm() {
    var name = document.getElementById('name').value;
    var number = document.getElementById('number').value;
    var degree = document.getElementById('degree').value;
    var desc = document.getElementById('desc').value;
    var year = document.getElementById('year').value;
    var email = document.getElementById('email').value;
    var skill1 = document.getElementById('skill1_name').value;
    var skill2 = document.getElementById('skill2_name').value;
    var skill3 = document.getElementById('skill3_name').value;
    var skill4 = document.getElementById('skill4_name').value;
    <?php if($act != 1){ ?>
    var upload = document.getElementById('upload').value;


    <?php }?>
    if (name == null || name == "") {
        alert("Name must be filled out");
        return false;
    }
    <?php if($act != 1){ ?>
    else if (!upload) {
        alert("Profile must be selected");
        return false;
    }

    <?php }?>
    else if (number == null || number == "") {
        alert("Student ID must be filled out");
        return false;
    }
    else if (degree == null || degree == "") {
        alert("Degree must be filled out");
        return false;
    }
    else if (year == null || year == "") {
        alert("Admission year must be filled out");
        return false;
    }
    else if (email == null || email == "") {
        alert("Email address must be filled out");
        return false;
    }
    else if (!skill1 || !skill2 || !skill3 || !skill4){
        alert("Skill address must be filled out");
        return false;
    }
    else if (desc == null || desc == "") {
        alert("Description must be filled out");
        return false;
    }
    else{
        return true;
    }
}
</script>

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
        <?php include("top.html");?>

        <!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Members</h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_three_third col_last nobottommargin">

                    <?php if($act == 1){ ?>
                        <h3>Modify Now.</h3>
                    <?php }else{ ?>
                        <h3>Register Now.</h3>
                    <?php } ?>

						<form enctype="multipart/form-data" id="register-form" name="register-form" class="nobottommargin" action="members_insert.php" method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="MAX_FILE_SIZE" value="512000">
							<div class="col_half">
								<label for="name">이름:</label>
                                <input type="text" name="name" id="name" placeholder="Korean" class="form-control" value="<?php if($act == 1) echo $name; ?>">
                                <input type="text" name="name2" id="name2" placeholder="English" class="form-control" value="<?php if($act == 1) echo $name2; ?>">
							</div>
							<div class="col_half col_last">
								<label for="upload">프로필 사진:<?php if($act==1) echo $row['PROFILE_PHOTO_URI'];?></label>
                                <input type="file" name="upload" id="upload" class="form-control"/>
							</div>

							<div class="clear"></div>

							<div class="col_half">
								<label for="number">학번:</label>
								<input type="text" name="number" id="number" placeholder="Student ID" class="form-control" value="<?php if($act == 1) echo $number; ?>">
							</div>
							<div class="col_half col_last">
                                <label for="degree">학위:</label>
                                <select name="degree" id="degree" class="form-control">
                                    <?php if($act == 1){?>
                                    <option value="-1">선택해 주십시오.</option>
                                    <option value='0' <?php if($degree == 0) echo "selected";?>>연구교수</option>
                                    <option value='1' <?php if($degree == 1) echo "selected";?>>박사 과정 재학</option>
                                    <option value='2' <?php if($degree == 2) echo "selected";?>>박사 졸업</option>
                                    <option value='3' <?php if($degree == 3) echo "selected";?>>석사 과정 재학</option>
                                    <option value='4' <?php if($degree == 4) echo "selected";?>>석사 졸업</option>
                                    <option value='6' <?php if($degree == 6) echo "selected";?>>석박통합과정 재학</option>
                                    <option value='5' <?php if($degree == 5) echo "selected";?>>인턴 | 학부연구생</option>

                                    <?php }else{ ?>

                                    <option value="-1" selected disabled>선택해 주십시오.</option>
                                    <option value='0'>연구교수</option>
                                    <option value='1'>박사 재학</option>
                                    <option value='2'>박사 졸업</option>
                                    <option value='3'>석사 재학</option>
                                    <option value='4'>석사 졸업</option>
                                    <option value='6'>석박 통합과정 재학</option>
                                    <option value='5'>인턴 | 학부연구생</option>
                                    <?php } ?>
                                </select>
							</div>

							<div class="clear"></div>

							<div class="col_half">
                                <label for="year">입학년도:</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="-1" selected>선택해 주십시오.</option>
                                    <?php
                                        if($act == 0)
                                            for($i=date("Y");$i>1960;$i--) {
                                                echo "<option value='{$i}'>{$i}</option>";
                                            }
                                        else
                                            for($i=date("Y");$i>1950;$i--) {
                                                if($i != $year)
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                else
                                                    echo "<option value='{$i}' selected>{$i}</option>";
                                            }

                                    ?>
                                </select>
							</div>

							<div class="col_half col_last">
                                <label for="gyear">졸업년도:</label>
                                <select name="gyear" id="gyear" class="form-control">
                                    <option value="-1" selected>졸업하지 않음.</option>
                                    <?php
                                        if($act == 0)
                                            for($i=date("Y");$i>1960;$i--) {
                                                echo "<option value='{$i}'>{$i}</option>";
                                            }
                                        else
                                            for($i=date("Y");$i>1950;$i--) {
                                                if($i != $gyear)
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                else
                                                    echo "<option value='{$i}' selected>{$i}</option>";
                                            }
                                    ?>
                                </select>
							</div>

							<div class="clear"></div>


							<div class="col_half">
                                <label for="email"><i class="icon-envelope-alt"></i>&nbsp;E-Mail:</label>
                                <input type="text" name="email" id="email" placeholder="E-mail address" class="form-control" value="<?php if($act == 1 && $email!=null) echo $email; elseif($email==null) echo '-';?>">
							</div>

							<div class="col_half col_last">
                                <label for="linkedin"><i class="icon-linkedin"></i>&nbsp;LinkedIn:</label>
                                <input type="text" name="linkedin" id="linkedin" placeholder="LinkedIn URL" class="form-control" value="<?php if($act == 1) echo $linkedin;?>">
							</div>

                            <div class="clear"></div>

							<div class="col_half">
                                <label for="facebook"><i class="icon-facebook"></i>&nbsp;Facebook:</label>
                                <input type="text" name="facebook" id="facebook" placeholder="Facebook URL" class="form-control" value="<?php if($act == 1) echo $fb;?>">
							</div>

							<div class="col_half col_last">
                                <label for="twit"><i class="icon-twitter"></i>&nbsp;Twitter:</label>
                                <input type="text" name="twit" id="twit" placeholder="Twitter URL" class="form-control" value="<?php if($act == 1) echo $tw;?>">
                            </div>

                            <div class="clear"></div>

							<div class="col_half">
                                <label for="insta"><i class="icon-instagram"></i>&nbsp;Instagram:</label>
                                <input type="text" name="insta" id="insta" placeholder="Instagram URL" class="form-control" value="<?php if($act == 1) echo $insta;?>">
							</div>

							<div class="col_half col_last">
                                <label for="blog"><i class="icon-blogger"></i>&nbsp;Blog:</label>
                                <input type="text" name="blog" id="blog" placeholder="Blog URL" class="form-control" value="<?php if($act == 1) echo $blog;?>">
							</div>

                            <div class="clear"></div>

							<div class="col_one_fourth">
                                <label for="skill1_name">스킬 1:</label>
                                <input type="text" id="skill1_name" name="skill1_name" class="form-control" placeholder="Skill Name" value="<?php if($act == 1 && $skill[0]['SKILL_NAME'] != null) echo $skill[0]['SKILL_NAME']; elseif($skill[0]['SKILL_NAME']==null) echo '-'; ?>" />
                                <input type="range" id="progressController1" min="0" max="100" value="<?php if($act == 1) echo $skill[0]['SKILL_SCORE']; else echo '0';?>"  class="sm-form-control"/>
                                <input type="text" name="skill1_val" id="skill1_val" class="sm-form-control" value="<?php if($act == 1) echo $skill[0]['SKILL_SCORE']; else echo '0';?>"/>
							</div>

							<div class="col_one_fourth">
                                <label for="skill2_name">스킬 2:</label>
                                <input type="text" id="skill2_name" name="skill2_name" class="form-control" placeholder="Skill Name" value="<?php if($act == 1 && $skill[1]['SKILL_NAME'] != null) echo $skill[1]['SKILL_NAME']; elseif($skill[1]['SKILL_NAME']==null) echo '-';?>"/>
                                <input type="range" id="progressController2" min="0" max="100" value="<?php if($act == 1) echo $skill[1]['SKILL_SCORE']; else echo '0';?>" class="sm-form-control" />
                                <input type="text" name="skill2_val" id="skill2_val" class="sm-form-control" value="<?php if($act == 1) echo $skill[1]['SKILL_SCORE']; else echo '0';?>"/>
							</div>

                            <div class="col_one_fourth">
                                <label for="skill3_name">스킬 3:</label>
                                <input type="text" id="skill3_name" name="skill3_name" class="form-control" placeholder="Skill Name" value="<?php if($act == 1 && $skill[2]['SKILL_NAME'] != null) echo $skill[2]['SKILL_NAME']; elseif($skill[2]['SKILL_NAME']==null) echo '-'; ?>"/>
                                <input type="range" id="progressController3" min="0" max="100" value="<?php if($act == 1) echo $skill[2]['SKILL_SCORE']; else echo '0';?>" class="sm-form-control" />
                                <input type="text" name="skill3_val" id="skill3_val" class="sm-form-control" value="<?php if($act == 1) echo $skill[2]['SKILL_SCORE']; else echo '0';?>"/>
							</div>

                            <div class="col_one_fourth col_last">
                                <label for="skill4_name">스킬 4:</label>
                                <input type="text" id="skill4_name" name="skill4_name" class="form-control" placeholder="Skill Name" value="<?php if($act == 1 && $skill[3]['SKILL_NAME'] != null) echo $skill[3]['SKILL_NAME']; elseif($skill[3]['SKILL_NAME']==null) echo '-'; ?>"/>
                                <input type="range" id="progressController4" min="0" max="100" value="<?php if($act == 1) echo $skill[3]['SKILL_SCORE']; else echo '0';?>" class="sm-form-control" />
                                <input type="text" name="skill4_val" id="skill4_val" class="sm-form-control" value="<?php if($act == 1) echo $skill[3]['SKILL_SCORE']; else echo '0';?>"/>
							</div>

                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="desc">자기소개:</label>
                                <textarea rows="8" name="desc" id="desc" placeholder="Description" class="form-control"><?php if($act == 1) echo $desc;?></textarea>
							</div>

							<div class="clear"></div>
                            <input type="hidden" name="act" id="act" value="<?php echo $act;?>"/>
                            <input type="hidden" name="upload_check" value="true" />
                            <?php if($act == 1){?>
                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                            <?php }?>
                            <div class="col_full nobottommargin">
								<button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register"><?php if($act == 0) echo "Register"; else echo "Modify";?></button>
							</div>
						</form>

					</div>

				</div>

			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
        <?php include('../footer.html'); ?>

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="../js/functions.js"></script>

</body>
</html>
