<?php
    include "config.php";
    $query = "select * from thesis";
    if (array_key_exists("search_keyword", $_POST)) {
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where title like '%$search_keyword%' or lead_author like '%$search_keyword%' or year like '%$search_keyword%'";
    }
    if (array_key_exists("page", $_GET)){
        $page = $_GET['page'];
        $offset = ($page - 1)*5; 
    }
    else{
        $offset = 0;
    }
    $query = $query . " order by year desc limit " . $offset ." , 5";
    $res = mysql_query($query, $conn);
    if (!$res) {
        die('Query Error : ' . mysql_error());
    }

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
	<title>ESEL - Papers</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="transparent-header full-header" data-sticky-class="not-dark">

        <?php include('header.php'); ?>


		</header><!-- #header end -->

		<section id="page-title" class="page-title-parallax page-title-dark" style="padding: 250px 0; background-image: url('res/papers.jpg'); background-size: cover; background-position: center center;" data-stellar-background-ratio="0.4">

			<div class="container clearfix">
				<h1>Published Papers</h1>
				<!-- <span>오늘도 불철주야 연구밖에 모르는 바보.. 넌 바보야!</span> -->
                			

			</div>

		</section>
		

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Post Content
					============================================= -->
					<div class="nobottommargin clearfix">

						<!-- Posts
						============================================= -->
						<div id="posts">

                            <?php
                            while($data = mysql_fetch_array($res)){
                                $id = $data['index'];
                                $ret = mysql_query("select count(*) as count from author where `index` = {$id}", $conn);
                                $count = mysql_fetch_array($ret);
                                $ret = mysql_query("select * from journal where `index` = {$id}", $conn);
                                $size = mysql_num_rows($ret);
                            ?>
                            
							<div class="entry clearfix">
								<div class="entry-title">
									<h2><a href="blog-single.html"><?php echo $data['title'];?></a></h2>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo $data['year'];?></li>
									<li><a href="#"><i class="icon-user"></i> <?php echo $data['lead_author'];?></a></li>
									<li><i class="icon-folder-open"></i> <?php for($i=0;$i<$size;$i++){$journal = mysql_fetch_array($ret); if($i != 0) echo ", " . $journal['name']; else echo $journal['name'];}?></li>
									<li><a href="blog-single.html#comments"><i class="icon-comments"></i> <?php echo $count[0]; ?> Co-authors</a></li>
								</ul>
								<div class="entry-content">
									<p><?php echo $data['abstract'];?></p>
									<a href="blog-single.html"class="more-link">Read More</a>
								</div>
							</div>

                            <?php
                            }
                            ?>
						   

						</div><!-- #posts end -->

						<!-- Pagination
						============================================= -->
						<ul class="pager nomargin">
							<li class="previous"><a href="#">&larr; Older</a></li>
							<li class="next"><a href="#">Newer &rarr;</a></li>
						</ul><!-- .pager end -->

					</div><!-- .postcontent end -->

					

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