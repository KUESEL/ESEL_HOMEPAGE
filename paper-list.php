<?php
    include "config.php";
    $query = "select * from papers";
    $num_rec_per_page = 5;
    if (array_key_exists("search_keyword", $_POST)) {
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where title like '%$search_keyword%' or lead_author like '%$search_keyword%' or year like '%$search_keyword%'";
    }
    if (array_key_exists("page", $_GET)){
        $page = $_GET['page'];
        $offset = ($page - 1)*$num_rec_per_page; 
    }
    else{
        $offset = 0;
    }
    $query = $query . " order by paper_published_at desc limit " . $offset ." , ".$num_rec_per_page;
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
                                $student = mysql_fetch_array(mysql_query("select * from members where STUDENT_ID={$data['STUDENT_ID']}",$conn));
                                switch($data['PAPER_CATEGORY']){
                                case 0: $cate = "국제 학술지"; break;
                                case 1: $cate = "국내 학술지"; break;
                                case 2: $cate = "국내 컨퍼런스"; break;
                                case 3: $cate = "국제 컨퍼런스"; break;
                                case 4: $cate = "특허"; break; 
                            }
                            ?>
                            
							<div class="entry clearfix">
								<div class="entry-title">
									<h2><a href="blog-single.html"><?php echo $data['PAPER_TITLE'];?></a></h2>
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
									<!-- <a href="<?php echo $data['PAPER_FULL_TEXT_LINK'];?>"class="more-link">Read More..</a> -->
								</div>
							</div>

                            <?php
                            }
                            ?>
						   

						</div><!-- #posts end -->

						<ul class="pagination">
							<li><a href="paper-list.php?page=1">◀</a></li>
						<?php 
							$query = "select * from papers";
							$res = mysql_query($query, $conn);
							$total_records = mysql_num_rows($res);  //count number of records
							$total_pages = ceil($total_records / $num_rec_per_page); 
							for($i=1;$i<=$total_pages;$i++){
								if( $_GET['page']==$i){
						?>
							<li class="active"><a href="paper-list.php?page=<?php echo $i ?>"><?php echo $i ?> <span class="sr-only">(current)</span></a></li>
							<?php } else{ ?>
						  	<li><a href="paper-list.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
						  	<?php 
						  		} 
					 		}
					 		?>
					 		<li><a href="paper-list.php?page=<?php echo $total_pages ?>">▶</a></li>
						   </ul>



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