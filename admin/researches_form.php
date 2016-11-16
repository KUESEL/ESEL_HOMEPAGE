<?php include("session.php") ?>
<!DOCTYPE html>
<?php
    include("config.php");
    $act = 0;
    if (array_key_exists("id", $_GET)) {
        $act = 1;
        $id = $_GET["id"];
        $res = mysql_query("select * from researches where RESEARCH_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $name = $row['RESEARCH_TOPIC'];
        $desc = $row['RESEARCH_DESC'];
        $degree = $row['RESEARCH_CATEGORY'];
        $sponser = $row['RESEARCH_SPONSER'];
        $term = $row['RESEARCH_TERM'];
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
	<title>Research Register</title>
    <?php }else{ ?>
	<title>Research Edit</title>
    <?php }?>
</head>

<body class="stretched">
<script>

function validateForm() {
    var name = document.getElementById('name').value;
    var degree = document.getElementById('degree').value;
    var desc = document.getElementById('desc').value;
    var sponser = document.getElementById('sponser').value;
    var term = document.getElementById('term').value;
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
    else if (degree == null || degree == "") {
        alert("Degree must be filled out");
        return false;
    }
    else if (sponser == null || sponser == "") {
        alert("Sponser must be filled out");
        return false;
    }
    else if (term == null || term == "") {
        alert("Term must be filled out");
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
				<h1>Researches</h1>
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

						<form enctype="multipart/form-data" id="register-form" name="register-form" class="nobottommargin" action="researches_insert.php" method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="MAX_FILE_SIZE" value="512000">
							<div class="col_half">
								<label for="name">연구 토픽 | 프로젝트 명:</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?php if($act == 1) echo $name; ?>">
							</div>
							<div class="col_half col_last">
								<label for="upload">사진:<?php if($act==1) echo $row['RESEARCH_PICT_URI'];?></label>
                                <input type="file" name="upload" id="upload" class="form-control"/>
							</div>

							<div class="clear"></div>

                            <div class="col_full">
                                <label for="degree">카테고리:</label>
                                <select name="degree" id="degree" class="form-control">
                                    <?php if($act == 1){?>
                                    <option value="-1">선택해 주십시오.</option>
                                    <option value='0' <?php if($degree == 0) echo "selected";?>>비활성화</option>
                                    <option value='1' <?php if($degree == 1) echo "selected";?>>연구실 메인 토픽 | 프로젝트</option>
                                    <option value='2' <?php if($degree == 2) echo "selected";?>>서브</option>
                                    <?php }else{ ?>

                                    <option value="-1" selected disabled>선택해 주십시오.</option>
                                    <option value='0'>비활성화</option>
                                    <option value='1'>연구실 메인 토픽 | 프로젝트</option>
                                    <option value='2'>서브</option>
                                    <?php } ?>
                                </select>
							</div>

							<div class="clear"></div>

							<div class="col_half">
								<label for="sponser">후원 및 관리기관:</label>
                                <input type="text" name="sponser" id="sponser" placeholder="Sponser" class="form-control" value="<?php if($act == 1) echo $sponser; ?>">
							</div>
							<div class="col_half col_last">
								<label for="term">연구 수행 기간:</label>
                                <input type="text" name="term" id="term" placeholder="ex) 2013.6 ~ 2014.8" class="form-control" value="<?php if($act == 1) echo $term; ?>">
							</div>



							<div class="clear"></div>

                            <div class="col_full">
                                <label for="desc">설명:</label>
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
