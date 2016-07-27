<!DOCTYPE html>
<?php
    include("config.php");
    $res = mysql_query("select * from members order by STUDENT_ID", $conn);
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
	<title>Members</title>

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
				<h1>Members</h1>
				<span>ESEL 연구원 관리 페이지</span>
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
						<li><a href="#" data-filter=".pf-0">연구교수</a></li>
						<li><a href="#" data-filter=".pf-1">박사 재학생</a></li>
						<li><a href="#" data-filter=".pf-3">석사 재학생</a></li>
						<li><a href="#" data-filter=".pf-5">학부연구생 | 인턴</a></li>
						<li><a href="#" data-filter=".pf-6">석박 통합과정생</a></li>
						<li><a href="#" data-filter=".pf-2">박사 졸업생</a></li>
						<li><a href="#" data-filter=".pf-4">석사 졸업생</a></li>

					</ul><!-- #portfolio-filter end -->
					<a href="members_form.php">
						<div id="portfolio-shuffle" class="portfolio-shuffle">
							<i class="icon-plus"></i>
						</div>
					</a>

					<div class="clear"></div>

					<!-- Portfolio Items
					============================================= -->
					<div id="portfolio" class="portfolio grid-container portfolio-6 clearfix">
                        <?php
                        while($row = mysql_fetch_array($res)){
                            switch($row['DEGREE']){
                                case 0: $degree = "연구교수"; break;
                                case 1: $degree = "박사 과정 재학"; break;
                                case 2: $degree = "박사 졸업"; break;
                                case 3: $degree = "석사 과정 재학"; break;
                                case 4: $degree = "석사 졸업"; break;
                                case 5: $degree = "석박통합과정 재학"; break;
                                case 6: $degree = "인턴 | 학부연구생"; break;
                            }
                        ?>
						<article class="portfolio-item pf-media pf-<?php  echo $row['DEGREE'];?>">
							<div class="portfolio-image">
								<a href="portfolio-single.html">
                                    <div style="background: url(<?php echo $row['PROFILE_PHOTO_URI'];?>) no-repeat ;height:200px;background-size:cover;"></div>
								</a>
								<div class="portfolio-overlay">
									<a href="members_form.php?id=<?php echo $row['STUDENT_ID'];?>" class="left-icon"><i class="icon-edit-sign"></i></a>
									<a href="#" onclick="if(confirm('<?php echo $row['STUDENT_NAME'];?>에 대한 모든 정보를 삭제하시겠습니까?  ')==true) {location.href='members_delete.php?id=<?php echo $row['STUDENT_ID'];?>'}" class="right-icon"><i class="icon-line-cross"></i></a>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="members_detail.php?id=<?php echo $row['STUDENT_ID'];?>"><?php echo $row['STUDENT_NAME'];?>
                                    <?php
                                        if($row['STUDENT_NAME_ENG']!=NULL){
                                    ?>
                                        <br/><small><?php echo $row['STUDENT_NAME_ENG'];?></small>
                                    <?php
                                        }
                                    ?>
                                    </a></h3>
								<span><?php echo $row['STUDENT_NUMBER'];?>, <?php echo $degree;?></span>
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