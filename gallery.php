<?php
    include("config.php");
    $query = "select *, YEAR(CREATED_AT) as YEAR from photos ORDER BY CREATED_AT DESC";
    $num_rec_per_page = 3;
    if (array_key_exists("page", $_GET)){
        $page = $_GET['page'];
        $offset = ($page - 1)*$num_rec_per_page; 
    }
    else{
        $offset = 0;
    }
    $query = $query . " limit " . $offset ." , ".$num_rec_per_page;

    $ret = mysql_query($query, $conn);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="css/colors.css" type="text/css" />

	<!-- Document Title
	============================================= -->
	<title>ESEL - Gallery</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="transparent-header full-header dark" data-sticky-class="not-dark">

        <?php include('header.php'); ?>


		</header><!-- #header end -->

		<section id="page-title" class="page-title-parallax page-title-dark" style="padding: 250px 0; background-image: url('res/gallery.jpg'); background-size: cover; background-position: center center;" data-stellar-background-ratio="0.4">

			<div class="container clearfix">
				<h1>GALLERY</h1>
				<span>하루하루 쌓여가는 ESEL 사진첩입니다.</span>
                			

			</div>

		</section>

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
                            $res = mysql_query("SELECT YEAR(CREATED_AT) as YEAR FROM photos WHERE 1 GROUP BY YEAR(CREATED_AT);", $conn);
                            while($y = mysql_fetch_array($res)){
                        ?>
						<li><a href="#" data-filter=".pf-<?php echo $y['YEAR'];?>"><?php echo $y['YEAR'];?></a></li>
                        <?php
                            }
                        ?>
					</ul>
                    <!-- #portfolio-filter end -->

						<ul class="pagination" style="float:right;">
							<li><a href="gallery.php?page=1">◀</a></li>
						<?php 
                            if ($page==null)
                                $page = 1;
                            
							$query = "select * from photos";
							$res = mysql_query($query, $conn);
							$total_records = mysql_num_rows($res);  //count number of records
							$total_pages = ceil($total_records / $num_rec_per_page); 
							for($i=1;$i<=$total_pages;$i++){
								if( $page==$i){
						?>
							<li class="active"><a href="gallery.php?page=<?php echo $i ?>"><?php echo $i ?><span class="sr-only">(current)</span></a></li>
							<?php } else{ ?>
						  	<li><a href="gallery.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
						  	<?php 
						  		} 
					 		}
					 		?>
					 		<li><a href="gallery.php?page=<?php echo $total_pages ?>">▶</a></li>
						   </ul>

					<div class="clear"></div>
					<br/>
					<!-- Portfolio Items
					============================================= -->
					<div id="portfolio" class="portfolio grid-container portfolio-3 clearfix">
                        <?php
                            while($photo = mysql_fetch_array($ret)){?>
						<article class="portfolio-item pf-media pf-<?php echo $photo['YEAR'];?>">
							<div class="portfolio-image">
								<a href="portfolio-single.php?index=<?php echo $photo['PHOTO_ID'];?>">
                                    <div style="background: url(admin/<?php echo $photo['PHOTO_URI']?>);height:300px;background-size:cover"></div>
								</a>
								<!-- <a href="portfolio-single.html">
									<img src="admin/<?php echo $photo['PHOTO_URI'];?>" alt="Open Imagination">
								</a> -->
								<div class="portfolio-overlay">
									<a href="admin/<?php echo $photo['PHOTO_URI'];?>" class= "center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="portfolio-single.html"><?php echo $photo['PHOTO_TITLE'];?></a></h3>
								<span><i class="icon-calendar3"></i> <?php echo substr($photo['CREATED_AT'],0,10);?> @<?php echo $photo['PHOTO_PLACE'];?> </span>
							</div>
						</article>
                        <?php
                        }?>
<!--
						<article class="portfolio-item pf-graphics pf-illustrations">
							<div class="portfolio-image">
								<div class="fslider" data-arrows="false">
									<div class="flexslider">
										<div class="slider-wrap">
											<div class="slide"><a href="portfolio-single-gallery.html"><img src="images/portfolio/3/6.jpg" alt="Shake It"></a></div>
											<div class="slide"><a href="portfolio-single-gallery.html"><img src="images/portfolio/3/6-1.jpg" alt="Shake It"></a></div>
											<div class="slide"><a href="portfolio-single-gallery.html"><img src="images/portfolio/3/6-2.jpg" alt="Shake It"></a></div>
											<div class="slide"><a href="portfolio-single-gallery.html"><img src="images/portfolio/3/6-3.jpg" alt="Shake It"></a></div>
										</div>
									</div>
								</div>
								<div class="portfolio-overlay" data-lightbox="gallery">
									<a href="images/portfolio/full/6.jpg" class="left-icon" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
									<a href="images/portfolio/full/6-1.jpg" class="hidden" data-lightbox="gallery-item"></a>
									<a href="images/portfolio/full/6-2.jpg" class="hidden" data-lightbox="gallery-item"></a>
									<a href="images/portfolio/full/6-3.jpg" class="hidden" data-lightbox="gallery-item"></a>
									<a href="portfolio-single-gallery.html" class="right-icon"><i class="icon-line-ellipsis"></i></a>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="portfolio-single-gallery.html">Shake It!</a></h3>
								<span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>
							</div>
						</article>
-->

					</div><!-- #portfolio end -->

				</div>

			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
        <?php include('footer.html'); ?>

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="js/functions.js"></script>

</body>
</html>