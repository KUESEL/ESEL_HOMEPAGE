<!DOCTYPE html>
<?php
    include("config.php");
    $act = 0;
    if (array_key_exists("id", $_GET)) {
        $act = 1;
        $id = $_GET["id"];
        $res = mysql_query("select * from photos where PHOTO_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $title = $row['PHOTO_TITLE'];
        $location = $row['PHOTO_PLACE'];
        $desc = $row['PHOTO_DESC'];
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
	<title>Gallery Register</title>
    <?php }else{ ?>
	<title>Photo Edit</title>
    <?php }?>
</head>

<body class="stretched">
<script>
function validateForm() {
    var title = document.getElementById('title').value;
    var location = document.getElementById('location').value;
    var desc = document.getElementById('desc').value;
    <?php if($act != 1){ ?>
    var upload = document.getElementById('upload').value;
    <?php }?>
    
    if (title == null || title == "") {
        alert("Title must be filled out");
        return false;
    }
    if (location == null || location == "") {
        alert("Location must be filled out");
        return false;
    }
    if (desc == null || desc == "") {
        alert("Description must be filled out");
        return false;
    }
    <?php if($act != 1){ ?>
    else if (!upload) {
        alert("Picture must be uploaded");
        return false;
    }
    <?php }?>

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
                        <h3>Edit Now.</h3>
                    <?php }else{ ?>
                        <h3>Register Now.</h3>
                    <?php } ?>    

						<form enctype="multipart/form-data" id="register-form" name="register-form" class="nobottommargin" action="photos_insert.php" method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="MAX_FILE_SIZE" value="5242888">
							<div class="col_full">
                                <?php if($act != 1){ ?>
								<label for="upload">사진:<?php if($act==1) echo $row['PROFILE_PHOTO_URI'];?></label>
                                <input type="file" name="upload" id="upload" class="form-control"/>
                                <?php }else{?>
                                <img src="<?php echo $row['PHOTO_URI'];?>" alt="">
                                <?php }?>
							</div>
							<div class="clear"></div>
							<div class="col_half">
								<label for="title">제목:</label>
                                <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="<?php if($act == 1) echo $title; ?>">
							</div>
							<div class="col_half col_last">
								<label for="location">장소:</label>
                                <input type="text" name="location" id="location" placeholder="Location" class="form-control" value="<?php if($act == 1) echo $location; ?>">
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