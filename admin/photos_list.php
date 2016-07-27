<!DOCTYPE html>
<?php
    include("config.php");
    $res = mysql_query("select *, YEAR(CREATED_AT) as YEAR from photos", $conn);
?>
<html>
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
	<title>Gallery</title>

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
				<h1>Gallery</h1>
				<span>ESEL Photos</span>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Portfolio Filter
					============================================= -->
					<ul id="portfolio-filter" class="portfolio-filter clearfix" data-container="#portfolio">
                        
						<li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                        <?php
                            $ret = mysql_query("SELECT YEAR(CREATED_AT) as YEAR FROM photos WHERE 1 GROUP BY YEAR(CREATED_AT);", $conn);
                            while($y = mysql_fetch_array($ret)){
                        ?>
						<li><a href="#" data-filter=".pf-<?php echo $y['YEAR'];?>"><?php echo $y['YEAR'];?></a></li>
                        <?php
                            }
                        ?>
					</ul><!-- #portfolio-filter end -->

					<div id="portfolio-shuffle" class="portfolio-shuffle">
						<a href="photos_form.php"><i class="icon-plus"></i></a>
					</div>

					<div class="clear"></div>

					<!-- Portfolio Items
					============================================= -->
					<div id="portfolio" class="portfolio grid-container portfolio-6 clearfix">
                        <?php
                        while($row = mysql_fetch_array($res)){
                        ?>
						<article class="portfolio-item pf-media pf-<?php echo $row['YEAR'];?>">
							<div class="portfolio-image">
								<a href="portfolio-single.html">
									<img src="<?php echo $row['PHOTO_URI'];?>" alt="Open Imagination">
								</a>
								<div class="portfolio-overlay">
									<a href="photos_form.php?id=<?php echo $row['PHOTO_ID'];?>" class="left-icon"><i class="icon-edit-sign"></i></a>
									<a href="#" onclick="if(confirm('<?php echo $row['PHOTO_TITLE'];?>에 대한 모든 정보를 삭제하시겠습니까?  ')==true) {location.href='photos_delete.php?id=<?php echo $row['PHOTO_ID'];?>'}" class="right-icon"><i class="icon-line-cross"></i></a>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><?php echo $row['PHOTO_TITLE'];?></h3>
								<span><?php echo $row['PHOTO_PLACE'];?>, <?php echo $row['CREATED_AT'];?></span>
								<span><?php echo $row['PHOTO_DESC'];?></span>
							</div>
						</article>
                        
                        <?php
                        } 
                        ?>
						

					</div><!-- #portfolio end -->

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