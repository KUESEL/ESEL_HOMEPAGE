<?php
    include "config.php";
    $query = "select * from papers";
    if (array_key_exists("category", $_GET)){
        $category = $_GET['category'];
        $offset = ($page - 1)*$num_rec_per_page; 
        $query = $query." where paper_category=".$category;
    }
    $query = $query." order by paper_published_at desc";
    // $num_rec_per_page = 5;
    // if (array_key_exists("search_keyword", $_POST)) {
    //     $search_keyword = $_POST["search_keyword"];
    //     $query =  $query . " where title like '%$search_keyword%' or lead_author like '%$search_keyword%' or year like '%$search_keyword%'";
    // }
    // if (array_key_exists("page", $_GET)){
    //     $page = $_GET['page'];
    //     $offset = ($page - 1)*$num_rec_per_page; 
    // }
    // else{
    //     $offset = 0;
    // }
    // $query = $query . " order by paper_published_at desc limit " . $offset ." , ".$num_rec_per_page;
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
		<header id="header" class="transparent-header full-header dark" data-sticky-class="not-dark">

        <?php include('header.php'); ?>


		</header><!-- #header end -->

		<section id="page-title" class="page-title-parallax page-title-dark" style="padding: 250px 0; background-image: url('res/papers.jpg'); background-size: cover; background-position: center center;" data-stellar-background-ratio="0.4">

			<div class="container clearfix">
				<h1>Published Papers</h1>
				 <span>ESEL 연구원들의 출판 논문들입니다.</span>
                			

			</div>

		</section>
		

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Post Content
					============================================= -->
					<div class="papers-container postcontent nobottommargin clearfix col_last">

						<!-- Posts
						============================================= -->
						<div id="mix_container" class="papers">

                            <?php
                            while($data = mysql_fetch_array($res)){
                                $id = $data['index'];
                                $ret = mysql_query("select count(*) as count from author where `index` = {$id}", $conn);
                                $count = mysql_fetch_array($ret);
                                $ret = mysql_query("select * from journal where `index` = {$id}", $conn);
                                $size = mysql_num_rows($ret);
                                $student = mysql_fetch_array(mysql_query("select * from members where STUDENT_ID={$data['STUDENT_ID']}",$conn));
                                switch($data['PAPER_CATEGORY']){
                                case 0: $cate = "국제 학술지"; break;
                                case 1: $cate = "국내 학술지"; break;
                                case 2: $cate = "국내 컨퍼런스"; break;
                                case 3: $cate = "국제 컨퍼런스"; break;
                                case 4: $cate = "특허"; break; 
                            }
                            ?>
                            
							<div class="mix entry clearfix <?php echo "category-".$data['PAPER_CATEGORY']?>" data-year="<?php echo $data['PAPER_PUBLISHED_AT']?>">
								<div class="entry-title">
									<h2><a href="#"><?php echo $data['PAPER_TITLE'];?></a></h2>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo $data['PAPER_PUBLISHED_AT'];?></li>
									<li><a href="#"><i class="icon-user"></i> <?php echo $student['STUDENT_NAME'];?></a></li>
									<li><i class="icon-users"></i> <?php echo $data['PAPER_AUTHORS'];?> </li>
									<li><i class="icon-tag"></i> <?php echo $cate;?> </li>
									<li><i class="icon-bookmark"></i><?php echo $data['PAPER_BELONGS_TO'];?></li>

									
								</ul>


								<div class="entry-content">
									<div class="toggle">
										<div class="togglet"><i class="toggle-closed icon-ok-circle"></i><i class="toggle-open icon-remove-circle"></i>Abstract</div>
										<div class="togglec"><?php echo $data['PAPER_ABSTRACTION'];?></div>
									</div>
									<br>
									<a href="<?php echo $data['PAPER_FULL_TEXT_LINK'];?>"><i class="icon-link"></i> Full Text Link</a>
								</div>
							</div>

                            <?php
                            }
                            ?>
						   

						</div><!-- #posts end -->

						<div class="pager-list topmargin nobottommargin">
							
						</div>

					</div><!-- .postcontent end -->

					
					<!-- Sidebar
					============================================= -->
					<div class="sidebar nobottommargin">
						<div class="sidebar-widgets-wrap">

							<div class="widget clearfix">
								<h4>Category</h4>
									 <button class="button button-rounded filter" data-filter="all">All</button>
									  <button class="button button-rounded filter" data-filter=".category-0">국제 학술지</button>
									  <button class="button button-rounded filter" data-filter=".category-1">국내 학술지</button>
									  <button class="button button-rounded filter" data-filter=".category-3">국제 학회</button>
									  <button class="button button-rounded filter" data-filter=".category-2">국내 학회</button>
									  <button class="button button-rounded filter" data-filter=".category-4">특허</button>
<!-- 
								<a href="paper-list.php" class="button button-rounded button-reveal button-large <? if(!array_key_exists("category", $_GET)){echo 'button_red';}else{ echo 'button-white button-light';}?>  tright"><i class="icon-line-arrow-right"></i><span>SHOW ALL</span></a>
								<a href="paper-list.php?category=0" class="button button-rounded button-reveal button-large <? if(array_key_exists("category", $_GET) && $category == 0){echo 'button_red';}else{ echo 'button-white button-light';}?> tright"><i class="icon-line-arrow-right"></i><span>국제 학술지</span></a>
								<a href="paper-list.php?category=1" class="button button-rounded button-reveal button-large <? if(array_key_exists("category", $_GET) && $category == 1){echo 'button_red';}else{ echo 'button-white button-light';}?> tright"><i class="icon-line-arrow-right"></i><span>국내 학술지</span></a>
								<a href="paper-list.php?category=3" class="button button-rounded button-reveal button-large <? if(array_key_exists("category", $_GET) && $category == 3){echo 'button_red';}else{ echo 'button-white button-light';}?> tright"><i class="icon-line-arrow-right"></i><span>국제 컨퍼런스</span></a>
								<a href="paper-list.php?category=2" class="button button-rounded button-reveal button-large <? if(array_key_exists("category", $_GET) && $category == 2){echo 'button_red';}else{ echo 'button-white button-light';}?> tright"><i class="icon-line-arrow-right"></i><span>국내 컨퍼런스</span></a>
								<a href="paper-list.php?category=4" class="button button-rounded button-reveal button-large <? if(array_key_exists("category", $_GET) && $category == 4){echo 'button_red';}else{ echo 'button-white button-light';}?> tright"><i class="icon-line-arrow-right"></i><span>특허</span></a>																																								
 -->
							</div>

						</div>
					</div><!-- .sidebar end -->



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
	<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="js/functions.js"></script>

	<script type="text/javascript">

		jQuery(document).ready(function($){
			$('#mix_container').mixItUp({
				controls:{
					enable: true
				},
				load:{
					page: 1
				},
				pagination: {
					limit: 5,
					loop: false,
					generatePagers: true,
					maxPagers: 5,
					pagerClass: '',
					prevButtonHTML:"<<",
					nextButtonHTML:">>",
				},
				selectors: {
					pagersWrapper: '.pager-list',
					pager:".pager"
				}
			});
		});

	</script>


</body>
</html>