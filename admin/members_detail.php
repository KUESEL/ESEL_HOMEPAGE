<!DOCTYPE html>
<?php
    include "config.php";
    if (array_key_exists("id", $_GET)) {
        $id = mysql_real_escape_string($_GET['id']);
        $ret = mysql_query("select * from members where STUDENT_ID = $id", $conn);
    
        $p = mysql_fetch_array($ret);
        $add = mysql_fetch_array(mysql_query("select STUDENT_ID from members where STUDENT_ID > $id ORDER BY STUDENT_ID", $conn));
        $minus = mysql_fetch_array(mysql_query("select STUDENT_ID from members where STUDENT_ID < $id ORDER BY STUDENT_ID DESC", $conn));
        
?>

<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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

	<!-- Document Title
	============================================= -->
	<title>Member Details</title>

</head>

<body class="stretched">

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
				<h1><?php echo $p['STUDENT_NAME'];?></h1>
                <?php if($p['STUDENT_NAME_ENG']!=NULL){ ?>
            
                <small><?php echo $p['STUDENT_NAME_ENG'];?></small>
            
                <?php } ?>
				<span><?php echo $p['STUDENT_NUMBER'];?></span>
				<div id="portfolio-navigation">
                    <?php if ($minus !=NULL){ ?>
					<a href="members_detail.php?id=<?php echo $minus[0];?>"><i class="icon-angle-left"></i></a>
                    <?php }?>
					<a href="members_list.php"><i class="icon-line-grid"></i></a>
                    <?php if ($add !=NULL){ ?>
					<a href="members_detail.php?id=<?php echo $add[0];?>"><i class="icon-angle-right"></i></a>
                    <?php }?>
				</div>
                <a href="members_form.php?id=<?php echo $id?>">Edit</a>
				
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Portfolio Single Image
					============================================= -->
					<div class="col_two_third portfolio-single-image nobottommargin">
						<a href="#"><img src="<?php echo $p['PROFILE_PHOTO_URI'];?>" alt=""></a>
					</div><!-- .portfolio-single-image end -->

					<!-- Portfolio Single Content
					============================================= -->
					<div class="col_one_third portfolio-single-content col_last nobottommargin">

						<!-- Portfolio Single - Description
						============================================= -->
						<div class="fancy-title title-bottom-border">
							<h2>자기소개</h2>
						</div>
						<p><?php echo $p['DESCP'];?></p>
						<!-- Portfolio Single - Description End -->
                        <?php
                            switch($p['DEGREE']){
                                case 0: $degree = "연구교수"; break;
                                case 1: $degree = "박사 과정 재학"; break;
                                case 2: $degree = "박사 졸업"; break;
                                case 3: $degree = "석사 과정 재학"; break;
                                case 4: $degree = "석사 졸업"; break;
                                case 5: $degree = "석박통합과정 재학"; break;
                                case 6: $degree = "인턴 | 학부연구생"; break;
                            }
                        ?>
						<div class="line"></div>

						<!-- Portfolio Single - Meta
						============================================= -->
						<ul class="portfolio-meta bottommargin">
							<li><span><i class="icon-user"></i>학위:</span> <?php echo $degree;?></li>
							<li><span><i class="icon-calendar3"></i>입학년도:</span> <?php echo $p['ADMISSION_YEAR'];?></li>
                            <?php if($p['DEGREE'] == 2 || $p['DEGREE'] == 4) {?><li><span><i class="icon-calendar3"></i>졸업년도:</span> <?php echo $p['GRADUATE_YEAR'];?></li><?php }?>
                            <?php 
                            $res = mysql_query("select * from skills where STUDENT_ID = $id", $conn);
                            $i = 1;
                            while($skill = mysql_fetch_array($res)){ ?>
							<li><span><i class="icon-lightbulb"></i>스킬 <?php echo $i;?>:</span><?php echo $skill['SKILL_NAME']." - ".$skill['SKILL_SCORE']."<br/>";?></li>
                            <?php $i += 1; }?>
                            <li><span><i class="icon-envelope-alt"></i>E-Mail :</span><?php echo $p['EMAIL'];?></li>
                            <?php if(!empty($p['LINKED_IN_URL'])){?>
                            <li><span><i class="icon-linkedin"></i>LinkedIn :</span><?php echo $p['LINKED_IN_URL'];?></li>
                            <?php }if(!empty($p['FACEBOOK_URL'])){?>
                            <li><span><i class="icon-facebook"></i>Facebook :</span><?php echo $p['FACEBOOK_URL'];?></li>
                            <?php }if(!empty($p['TWITTER_URL'])){?>
                            <li><span><i class="icon-twitter"></i>Twitter :</span><?php echo $p['TWITTER_URL'];?></li>
                            <?php }if(!empty($p['INSTAGRAM_URL'])){?>
                            <li><span><i class="icon-instagram"></i>Instagram :</span><?php echo $p['INSTAGRAM_URL'];?></li>
                            <?php }if(!empty($p['BLOG_URL'])){?>
                            <li><span><i class="icon-blogger"></i>Blog :</span><?php echo $p['BLOG_URL'];?></li>
                            <?php }?>
						</ul>
						<!-- Portfolio Single - Meta End -->


					</div><!-- .portfolio-single-content end -->

					<div class="clear"></div>

					<div class="divider divider-center"><i class="icon-circle"></i></div>

					<!-- Related Portfolio Items
					============================================= -->

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
<?php
    }
?>