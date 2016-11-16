<?php include("session.php") ?>
<!DOCTYPE html>
<?php
    include("config.php");
    $query = "select * from articles";
    $num_rec_per_page = 6;
    if (array_key_exists("page", $_GET)){
        $page = $_GET['page'];
        $offset = ($page - 1)*$num_rec_per_page;
    }
    else{
        $offset = 0;
    }
    $query = $query . " limit " . $offset ." , ".$num_rec_per_page;

    $res = mysql_query($query, $conn);
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
	<title>ARTICLE</title>

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
				<h1>ARTICLE</h1>
				<span>ESEL 기사 관리 페이지</span>
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
                            $ret = mysql_query("SELECT ARTICLE_PUBLISHED_YEAR as YEAR FROM articles WHERE 1 GROUP BY ARTICLE_PUBLISHED_YEAR;", $conn);
                            while($y = mysql_fetch_array($ret)){
                        ?>
						<li><a href="#" data-filter=".pf-<?php echo $y['YEAR'];?>"><?php echo $y['YEAR'];?></a></li>
                        <?php
                            }
                        ?>
					</ul><!-- #portfolio-filter end -->
					<a href="articles_form.php">
						<div id="portfolio-shuffle" class="portfolio-shuffle">
							<i class="icon-plus"></i>
						</div>
					</a>
					<div class="clear"></div>
						<ul class="pagination" style="float:right;">
							<li><a href="articles_list.php?page=1">◀</a></li>
						<?php
                            if (!isset($page))
                                $page = 1;

							$query = "select * from articles";
							$ret = mysql_query($query, $conn);
							$total_records = mysql_num_rows($ret);  //count number of records
							$total_pages = ceil($total_records / $num_rec_per_page);
							for($i=1;$i<=$total_pages;$i++){
								if( $page==$i){
						?>
							<li class="active"><a href="articles_list.php?page=<?php echo $i ?>"><?php echo $i ?><span class="sr-only">(current)</span></a></li>
							<?php } else{ ?>
						  	<li><a href="articles_list.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
						  	<?php
						  		}
					 		}
					 		?>
					 		<li><a href="articles_list.php?page=<?php echo $total_pages ?>">▶</a></li>
						   </ul>

					<div class="clear"></div>

					<!-- Portfolio Items
					============================================= -->
					<div id="portfolio" class="portfolio grid-container portfolio-6 clearfix">
                        <?php
                        while($row = mysql_fetch_array($res)){
                        ?>
						<article class="portfolio-item pf-media pf-<?php echo $row['ARTICLE_PUBLISHED_YEAR'];?>">
							<div class="portfolio-image">
								<a href="portfolio-single.html">
									<img src="<?php echo $row['ARTICLE_THUMBNAIL_URI'];?>" alt="Open Imagination">
								</a>
								<div class="portfolio-overlay">
									<a href="articles_form.php?id=<?php echo $row['ARTICLE_ID'];?>" class="left-icon"><i class="icon-edit-sign"></i></a>
									<a href="#" onclick="if(confirm('<?php echo $row['ARTICLE_TITLE'];?>에 대한 모든 정보를 삭제하시겠습니까?  ')==true) {location.href='articles_delete.php?id=<?php echo $row['ARTICLE_ID'];?>'}" class="right-icon"><i class="icon-line-cross"></i></a>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="http://<?php echo $row['ARTICLE_URL'];?>"><?php echo $row['ARTICLE_TITLE'];?></a></h3>
                                <span><?php echo $row['ARTICLE_PUBLISHED_YEAR'];?>년&nbsp;<?php echo $row['ARTICLE_PUBLISHED_MONTH'];?>월&nbsp;<?php echo $row['ARTICLE_PUBLISHED_DAY'];?>일</span>
								<span><?php echo $row['ARTICLE_SUMMARY'];?></span>
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
