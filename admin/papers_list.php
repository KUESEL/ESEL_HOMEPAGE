<!DOCTYPE html>
<?php
    include("config.php");
    $res = mysql_query("select * from papers order by PAPER_PUBLISHED_AT desc", $conn);
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
	<title>Papers</title>

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
				<h1>Papers</h1>
				<span>ESEL papers</span>
				<div id="portfolio-navigation">
					<a href="papers_form.php"><i class="icon-plus"></i></a>
				</div>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<h3>Papers!</h3>

					<p>papers published by ESEL members.</p>

					<div class="divider"><i class="icon-circle"></i></div>

					<div class="col_full">
                        <?php
                        while($p = mysql_fetch_array($res)){
                            switch($p['PAPER_CATEGORY']){
                                case 0: $cate = "국제 학술지"; break;
                                case 1: $cate = "국내 학술지"; break;
                                case 2: $cate = "국내 컨퍼런스"; break;
                                case 3: $cate = "국제 컨퍼런스"; break;
                                case 4: $cate = "특허"; break; 
                            }
                            $s = mysql_fetch_array(mysql_query("select * from members where STUDENT_ID={$p['STUDENT_ID']}",$conn));
                        ?>
						<h4><?php echo $p['PAPER_TITLE'];?><small>(<?php echo $p['PAPER_PUBLISHED_AT'];?>)</small></h4>
						저자: <a href="members_detail.php?id=<?php echo $s['STUDENT_ID'];?>"><?php echo $s['STUDENT_NAME'];?></a><br/>
						공동저자: <?php echo $p['PAPER_AUTHORS'];?><br/>
						<?php echo $cate;?>, <?php echo $p['PAPER_BELONGS_TO'];?><br/>
						<a href="<?php echo $p['PAPER_FULL_TEXT_LINK'];?>" class="button button-mini"><div>Full Text Link</div></a>
						<br/><br/>
				                             <div class="toggle toggle-border">
							<div class="togglet"><i class="toggle-closed icon-ok-circle"></i><i class="toggle-open icon-remove-circle"></i>Abstract </div>
							<div class="togglec"><?php echo $p['PAPER_ABSTRACTION'];?></div>

						</div>
					  
						<a href="papers_form.php?id=<?php echo $p['PAPER_ID'];?>">Edit</a>&nbsp;/
						<a href="#" onclick="if(confirm('<?php echo $p['PAPER_TITLE'];?>에 대한 모든 정보를 삭제하시겠습니까?  ')==true) {location.href='papers_delete.php?id=<?php echo $p['PAPER_ID'];?>'}">Delete</a>
						<div class="divider">&nbsp;</div>
                        <?php
                        }
                        ?>

					</div>


				</div>

			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
        <?php include('../footer.html');?>

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