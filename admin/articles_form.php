<!DOCTYPE html>
<?php
    include("config.php");
    $act = 0;
    if (array_key_exists("id", $_GET)) {
        $act = 1;
        $id = $_GET["id"];
        $res = mysql_query("select * from articles where ARTICLE_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $title = $row['ARTICLE_TITLE'];
        $link = $row['ARTICLE_URL'];
        $year = $row['ARTICLE_PUBLISHED_YEAR'];
        $month = $row['ARTICLE_PUBLISHED_MONTH'];
        $day = $row['ARTICLE_PUBLISHED_MONTH'];
        $desc = $row['ARTICLE_SUMMARY'];
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
	<title>Article Register</title>
    <?php }else{ ?>
	<title>Article Edit</title>
    <?php }?>
</head>

<body class="stretched">
<script>

function validateForm() {
    var title = document.getElementById('title').value;
    var link = document.getElementById('link').value;
    var desc = document.getElementById('desc').value;
    var year = document.getElementById('year').value;
    var month = document.getElementById('month').value;
    var day = document.getElementById('day').value;
    <?php if($act != 1){ ?>
    var upload = document.getElementById('upload').value;
    
    
    <?php }?>
    if (title == null || title == "") {
        alert("Title must be filled out");
        return false;
    }
    if (link == null || link == "") {
        alert("Link URL must be filled out");
        return false;
    }
    else if (year == null || year == "") {
        alert("Year must be selected");
        return false;
    }
    else if (month == null || month == "") {
        alert("Month must be selected");
        return false;
    }
    else if (day == null || day == "") {
        alert("Date must be selected");
        return false;
    }
    <?php if($act != 1){ ?>
    else if (!upload) {
        alert("Picture must be selected");
        return false;
    }
    
    <?php }?>
    else if (desc == null || desc == "") {
        alert("Summary must be filled out");
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
				<h1>Articles</h1>
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

						<form enctype="multipart/form-data" id="register-form" name="register-form" class="nobottommargin" action="articles_insert.php" method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="MAX_FILE_SIZE" value="5242888">
							<div class="col_half">
								<label for="title">기사 제목:</label>
                                <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="<?php if($act == 1) echo $title; ?>">
							</div>
							<div class="col_half col_last">
								<label for="link">기사 링크:</label>
                                <input type="text" name="link" id="link" placeholder="Link URL" class="form-control" value="<?php if($act == 1) echo $link; ?>">
							</div>

							<div class="clear"></div>

							<div class="col_one_third">
                                <label for="year">게재 년도:</label>
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
							<div class="col_one_third">
                                <label for="month">게재 월:</label>
                                <select name="month" id="month" class="form-control">
                                    <option value="-1" selected>선택해 주십시오.</option>
                                    <?php
                                        if($act == 0)
                                            for($i=1;$i<=12;$i++) {
                                                echo "<option value='{$i}'>{$i}월</option>";
                                            }
                                        else
                                            for($i=1;$i<=12;$i++) {
                                                if($i != $month)
                                                    echo "<option value='{$i}'>{$i}월</option>";
                                                else
                                                    echo "<option value='{$i}' selected>{$i}월</option>";
                                            }
                                        
                                    ?>
                                </select>
							</div>
							<div class="col_one_third col_last">
                                <label for="day">게재 일:</label>
                                <select name="day" id="day" class="form-control">
                                    <option value="-1" selected>선택해 주십시오.</option>
                                    <?php
                                        if($act == 0)
                                            for($i=1;$i<=31;$i++) {
                                                echo "<option value='{$i}'>{$i}일</option>";
                                            }
                                        else
                                            for($i=1;$i<=31;$i++) {
                                                if($i != $day)
                                                    echo "<option value='{$i}'>{$i}일</option>";
                                                else
                                                    echo "<option value='{$i}' selected>{$i}일</option>";
                                            }
                                        
                                    ?>
                                </select>
							</div>

							<div class="clear"></div>
                            
							<div class="col_full">
								<label for="upload">사진:<?php if($act==1) echo $row['ARTICLE_THUMBNAIL_URI'];?></label>
                                <input type="file" name="upload" id="upload" class="form-control"/>
							</div>


                            
							<div class="clear"></div>

                            <div class="col_full">
                                <label for="desc">기사 한줄 미리보기:</label>
                                <textarea rows="8" name="desc" id="desc" placeholder="Summary" class="form-control"><?php if($act == 1) echo $desc;?></textarea>
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