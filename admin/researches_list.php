<?php include("session.php") ?>
<!DOCTYPE html>
<?php
    include("config.php");
    $query = "select * from researches";
    $num_rec_per_page = 4;
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
	<title>RESEARCH</title>

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
				<h1>RESEARCH</h1>
				<span>ESEL 연구주제 관리 페이지</span>
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
						<li><a href="#" data-filter=".pf-0">비활성화</a></li>
						<li><a href="#" data-filter=".pf-1">연구실 메인 토픽 | 프로젝트</a></li>
						<li><a href="#" data-filter=".pf-2">서브</a></li>
					</ul><!-- #portfolio-filter end -->
					<a href="researches_form.php">
						<div id="portfolio-shuffle" class="portfolio-shuffle">
							<i class="icon-plus"></i>
						</div>
					</a>
					<div class="clear"></div>
						<ul class="pagination" style="float:right;">
							<li><a href="researches_list.php?page=1">◀</a></li>
						<?php
                            if (!isset($page))
                                $page = 1;

							$query = "select * from researches";
							$ret = mysql_query($query, $conn);
							$total_records = mysql_num_rows($ret);  //count number of records
							$total_pages = ceil($total_records / $num_rec_per_page);
							for($i=1;$i<=$total_pages;$i++){
								if( $page==$i){
						?>
							<li class="active"><a href="researches_list.php?page=<?php echo $i ?>"><?php echo $i ?><span class="sr-only">(current)</span></a></li>
							<?php } else{ ?>
						  	<li><a href="researches_list.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
						  	<?php
						  		}
					 		}
					 		?>
					 		<li><a href="researches_list.php?page=<?php echo $total_pages ?>">▶</a></li>
						   </ul>

					<div class="clear"></div>
					<!-- Portfolio Items
					============================================= -->
					<div id="portfolio" class="portfolio grid-container portfolio-4 clearfix">
                        <?php
                        while($row = mysql_fetch_array($res)){
                            switch($row['RESEARCH_CATEGORY']){
                                case 0: $cate = "비활성화"; break;
                                case 1: $cate = "연구실 메인 토픽 | 프로젝트"; break;
                                case 2: $cate = "서브"; break;
                            }
                        ?>
						<article class="portfolio-item pf-media pf-<?php echo $row['RESEARCH_CATEGORY'];?>">
							<div class="portfolio-image">
								<a href="portfolio-single.html">
                  <div style="background: url(<?php echo $row['RESEARCH_PICT_URI'];?>) no-repeat ;height:150px;background-size:cover;"></div>

								</a>
								<div class="portfolio-overlay">
									<a href="researches_form.php?id=<?php echo $row['RESEARCH_ID'];?>" class="left-icon"><i class="icon-edit-sign"></i></a>
									<a href="#" onclick="if(confirm('<?php echo $row['RESEARCH_TOPIC'];?>에 대한 모든 정보를 삭제하시겠습니까?  ')==true) {location.href='researches_delete.php?id=<?php echo $row['RESEARCH_ID'];?>'}" class="right-icon"><i class="icon-line-cross"></i></a>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><?php echo $row['RESEARCH_TOPIC'];?></h3>
								<span><?php echo $cate;?></span>
						                                <span><?php echo $row['RESEARCH_TERM'];?></span>
						                                <span>후원: <?php echo $row['RESEARCH_SPONSER'];?></span>
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
