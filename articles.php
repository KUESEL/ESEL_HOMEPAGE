<!DOCTYPE html>
<?php
    include("config.php");
    $query = "select * from articles ORDER BY ARTICLE_PUBLISHED_YEAR DESC, ARTICLE_PUBLISHED_MONTH DESC, ARTICLE_PUBLISHED_DAY DESC";
    $num_rec_per_page = 2;
    if (array_key_exists("more", $_GET)){
        $more = $_GET['more'];
        $y = $_GET['y'];
        $m = $_GET['m'];

    }
    else{
        $more = 1;
        $y = 0;
        $m = 0;
    }
    $query = $query . " limit ". (($more - 1) * $num_rec_per_page) . ", ".($more * $num_rec_per_page);

    $ret = mysql_query($query, $conn);
?>

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
	<title>ESEL - Articles</title>

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

 		<section id="page-title" class="page-title-parallax page-title-dark" style="padding: 250px 0; background-image: url('res/articles.jpg'); background-size: cover; background-position: center center;" data-stellar-background-ratio="0.4">

			<div class="container clearfix">
				<h1>ARTICLES</h1>
				<span>ESEL과 관련된 보도자료들입니다.</span>
                			

			</div>

		</section>

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Posts
					============================================= -->
					<div id="posts" class="post-grid grid-container post-masonry post-timeline grid-2 clearfix">

						<div class="timeline-border"></div>
                        <?php
                        while($article = mysql_fetch_array($ret)){
                        if($y != $article['ARTICLE_PUBLISHED_YEAR'] || $m != $article['ARTICLE_PUBLISHED_MONTH']){
                            $y = $article['ARTICLE_PUBLISHED_YEAR'];
                            $m = $article['ARTICLE_PUBLISHED_MONTH'];
                            $monthName = date('M', mktime(0, 0, 0, $m, 10));
                        ?>
						<div class="entry entry-date-section notopmargin"><span><?php echo $monthName." ".$y;?></span></div>
                        <?php } ?>
                        
                        
						<div class="entry clearfix">
							<div class="entry-timeline">
								<div class="timeline-divider"></div>
							</div>
							<div class="entry-image">
								<a href="admin/<?php echo $article['ARTICLE_THUMBNAIL_URI'];?>" data-lightbox="image"><img class="image_fade" src="admin/<?php echo $article['ARTICLE_THUMBNAIL_URI'];?>" alt="Standard Post with Image"></a>
							</div>
							<div class="entry-title">
								<h2><a href="blog-single.html"><?php echo $article['ARTICLE_TITLE'];?></a></h2>
							</div>
							<ul class="entry-meta clearfix">
								<li><i class="icon-calendar3"></i> <?php echo $article['ARTICLE_PUBLISHED_YEAR']."-".$article['ARTICLE_PUBLISHED_MONTH']."-".$article['ARTICLE_PUBLISHED_DAY'];?></li>
							</ul>
							<div class="entry-content">
								<p><?php echo $article['ARTICLE_SUMMARY'];?></p>
								<a href="http://<?php echo $article['ARTICLE_URL'];?>" class="more-link">Read More</a>
							</div>
						</div>
                        <?php } ?>

					</div><!-- #posts end -->

					<div id="load-next-posts" class="center">
						<a href="articles.php?more=<?php echo ++$more;?>&y=<?php echo $y;?>&m=<?php echo $m;?>" class="button button-3d button-dark button-large button-rounded">Load more..</a>
					</div>

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

	<script type="text/javascript">

		jQuery(window).load(function(){

			var $container = $('#posts');

			$container.isotope({
				itemSelector: '.entry',
				masonry: {
					columnWidth: '.entry:not(.entry-date-section)'
				}
			});

			$container.infinitescroll({
				loading: {
					finishedMsg: '<i class="icon-line-check"></i>',
					msgText: '<i class="icon-line-loader icon-spin"></i>',
					img: "images/preloader-dark.gif",
					speed: 'normal'
				},
				state: {
					isDone: false
				},
				nextSelector: "#load-next-posts a",
				navSelector: "#load-next-posts",
				itemSelector: "div.entry",
				behavior: 'portfolioinfiniteitemsloader'
			},
			function( newElements ) {
				$container.isotope( 'appended', $( newElements ) );
				var t = setTimeout( function(){ $container.isotope('layout'); }, 2000 );
				SEMICOLON.initialize.resizeVideos();
				SEMICOLON.widget.loadFlexSlider();
				SEMICOLON.widget.masonryThumbs();
				var t = setTimeout( function(){
					SEMICOLON.initialize.blogTimelineEntries();
				}, 2500 );
			});

			var t = setTimeout( function(){
				SEMICOLON.initialize.blogTimelineEntries();
			}, 2500 );

			$(window).resize(function() {
				$container.isotope('layout');
				var t = setTimeout( function(){
					SEMICOLON.initialize.blogTimelineEntries();
				}, 2500 );
			});

		});

	</script>

</body>
</html>