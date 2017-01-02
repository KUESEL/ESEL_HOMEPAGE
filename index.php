<?php
include "config.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<!-- Stylesheets
	============================================= -->
    	<link href="http://fonts.googleapis.com/earlyaccess/nanumpenscript.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/medical-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<link rel="shortcut icon" href="/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
    	<link rel="stylesheet" href="css/colors.css" type="text/css" />

	<!-- Document Title
	============================================= -->
	<title>ESEL</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="transparent-header full-header dark" data-sticky-class="not-dark">
            <?php
include('header.php');
?>
		</header><!-- #header end -->

       		 <section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">
			<div class="slider-parallax-inner">

				<div class="swiper-container swiper-parent">
					<div class="swiper-wrapper">
						<div class="swiper-slide dark" style="background-image: url('res/embedded_background_2.jpg');">
							<div class="container clearfix">
								<div class="slider-caption slider-caption-left">
								</div>
							</div>
						</div>
						<div class="swiper-slide dark" style="background-image: url('res/mainphoto1.jpg');">
							<div class="container clearfix">
								<div class="slider-caption slider-caption-center">
								</div>
							</div>
						</div>

					</div>
					<div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
					<div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
				</div>

				<a href="#" data-scrollto="#content" data-offset="100" class="dark one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a>

			</div>
		</section>

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">

				<!-- 연구실 간략 소개 -->
				<div class="container clearfix bottommargin-lg">
					<div class="row clearfix">

						<div class="col-lg-6 col-sm-12">
							<div class="heading-block topmargin">
								<h1>임베디드 소프트웨어 공학 연구실 <br>홈페이지에 오신것을 환영합니다</h1>
							</div>
							<p class="lead"> 고려대학교 임베디드 소프트웨어 공학 연구실은 지도교수님이신 인호 교수님께서 2003년도 고려대학교 교수로 임용되시면서 설립되었습니다. 현재 저희 연구실에서 다루고있는 연구 주제는 크게 4가지 분야로 나누어져있습니다.
							</p>


						</div>

						<div class="col-lg-6 col-sm-12 hidden-xs">
							<div style="position: relative; margin-bottom: -100px;" class="ohidden" data-height-lg="500" data-height-md="720" data-height-sm="640" data-height-xs="450" data-height-xxs="350">
								<img src="res/computer.png" style="position: absolute; top: 155px; left: 30; width: 300px" data-animate="fadeInUp" data-delay="50" alt="Computer">
								<img src="res/chipset.png" style="position: absolute; top: 25px; left: 210px; width: 300px" data-animate="fadeInUp" data-delay="300" alt="Chipset">
								<img src="res/gear.png" style="position: absolute; top: 25px; left: 110px;" data-animate="fadeInUp" data-delay="500" alt="Gear">
								<img src="res/gear.png" style="position: absolute; top: 255px; left: 340px; width: 150px" data-animate="fadeInUp" data-delay="700" alt="Gear">

							</div>
						</div>

					</div>
				</div>

				<div class="section nobottommargin notopmargin">
					<div class="container clear-bottommargin clearfix">
						<div class="row notopmargin clearfix">
							<div class="col-md-3 bottommargin center">
								<a href="researches.php" >
									<i class="i-plain color i-large icon-medical-i-mental-health inline-block" style="margin-bottom: 15px;"></i>
								</a>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">
									<span class="before-heading">Self-Adaptive <br>Software Engineering</span>
									<h4>자가적응형<br/> 소프트웨어 공학</h4>
								</div>
								<!-- <p>Employment respond committed meaningful fight against oppression social challenges rural legal aid governance. Meaningful work, implementation, process cooperation, campaign inspire.</p> -->
							</div>

							<div class="col-md-3 bottommargin center">
								<a href="researches.php" >
									<i class="i-plain color i-large icon-bitcoin2 inline-block" style="margin-bottom: 15px;"></i>
								</a>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">
									<span class="before-heading">FinTech Software Engineering <br> based on Blockchain</span>
									<h4>블록체인 기반 <br/>핀테크 소프트웨어 공학</h4>
								</div>
								<!-- <p>Medecins du Monde Jane Addams reduce child mortality challenges Ford Foundation. Diversification shifting landscape advocate pathway to a better life rights international. Assessment.</p> -->
							</div>

							<div class="col-md-3 bottommargin center">
								<a href="researches.php" >
									<i class="i-plain color i-large icon-medical-cardiology inline-block" style="margin-bottom: 15px;"></i>
								</a>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">
									<span class="before-heading">Smart Health System <br> using Bio Signal</span>
									<h4>생체 신호 기반 <br/> 스마트 헬스케어 시스템</h4>
								</div>
								<!-- <p>Democracy inspire breakthroughs, Rosa Parks; inspiration raise awareness natural resources. Governance impact; transformative donation philanthropy, respect reproductive.</p> -->
							</div>
							<div class="col-md-3 bottommargin center">
								<a href="researches.php" >
									<i class="i-plain color i-large icon-sort-by-alphabet-alt inline-block" style="margin-bottom: 15px;"></i>
								</a>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">
									<span class="before-heading"> Software Quality Assuarance <br>based on Test</span>
									<h4>테스트 기반<br> 소프트웨어 품질 검증</h4>
								</div>
								<!-- <p>Democracy inspire breakthroughs, Rosa Parks; inspiration raise awareness natural resources. Governance impact; transformative donation philanthropy, respect reproductive.</p> -->
							</div>
						</div>
						<div class="row notopmargin clearfix center" style="margin-bottom: 30px">
							<a href="researches.php" class="button button-border button-dark button-rounded button-large noleftmargin ">더 알아보기</a>
						</div>
					</div>
				</div>

				<div class="section parallax dark notopmargin nobottommargin" style="background-image: url('res/members/background.jpg'); background-size: cover; " data-stellar-background-ratio="0.2">
				</br></br></br></br></br></br></br>
				<h1 class="center nomargin"> ESEL의 연구원들은 자유로운 환경에서 <b style="color:#fcffb7">노력</b>을 <b style="color:#adf7e9">혁신</b>으로 만듭니다. </h1>
				</br></br></br></br></br></br></br>
				</div>

				<!-- 교수님 동영상-->
				<div class="row clearfix bottommargin-lg common-height">

					<div class="col-md-3 center col-padding topmargin-sm nobottommargin" style="background: url('res/hohin2.jpg') center center no-repeat; background-size: contain">
					</div>

					<div class="col-md-9 center col-padding" style="background-color: #F5F5F5;">
						<div>
							<div class="heading-block nobottommargin">
								<h1><strong>인호 (Hoh Peter In)</strong></h1>
								<h4><strong>지도 교수</strong></h4>
							</div>
							<div class="center nobottommargin topmargin-sm">
								<a href="https://www.youtube.com/watch?v=wyJUncPNT5M" data-lightbox="iframe" style="position: relative;">
									<img src="res/professor/arirang_interview.jpg" alt="Video" style="width:50%">
									<span class="i-overlay nobg"><img src="images/icons/video-play.png" alt="Play"></span>
								</a>
							</div>
							<div class="row  clearfix center" style="margin-top:22px">
								<a href="professor.php" class="button button-border button-dark button-rounded button-large noleftmargin "> 교수님 소개 바로가기</a>
							</div>
							<!-- <a href="about-me.php" class="lead nobottommargin" style="position: absolute; right: 80px">교수님 소개 바로가기</a> -->
						</div>
					</div>

				</div>


                <div class="container clearfix nobottommargin">

                    <div class="row topmargin-sm">

                        <div class="heading-block center">
                            <h3>Members</h3>
                        </div>
                        <?php
$query = "select * from members order by STUDENT_NUMBER";
$res   = mysql_query($query, $conn);
if (!$res) {
    die('Query Error : ' . mysql_error());
}
while ($member = mysql_fetch_array($res)) {
    if ($member['DEGREE'] != 2 && $member['DEGREE'] != 4 && $member['DEGREE'] != 7) {
?>

                        <div class="col-md-3 col-sm-6 bottommargin">
                            <div class="team">
                                <div class="team-image">
                                    <a href="members.php#<?php echo $member['STUDENT_NAME']; ?>">
	                              <img  style="background: url(admin/<?php echo $member['PROFILE_PHOTO_URI'];?>) no-repeat; height: 300px; background-size:cover">
                                    </a>
                                </div>
                                <?php
        switch ($member['DEGREE']) {
            case 0:
                $degree = "연구교수";
                break;
            case 1:
                $degree = "박사 과정";
                break;
            case 2:
                $degree = "박사 졸업";
                break;
            case 3:
                $degree = "석사 과정";
                break;
            case 4:
                $degree = "석사 졸업";
                break;
            case 6:
                $degree = "석박통합과정";
                break;
            case 5:
                $degree = "인턴|학부연구생";
                break;
            default:
                $degree = "";
                break;
        }

?>
                                <div class="team-desc team-desc-bg">
                                    <div class="team-title">
                                    	<h4><?php echo $member['STUDENT_NAME'];?></h4>
                                    	<span><strong><?php echo $degree;?></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
    }
}
?>

                    </div>

                </div>





				<div class="section notopmargin nobottommargin nobottomborder">
					<div class="container clearfix">
						<div class="heading-block center nomargin">
							<h3>Gallery</h3>
						</div>
					</div>
				</div>
				<div id="portfolio" class="portfolio portfolio-nomargin grid-container portfolio-notitle portfolio-full grid-container clearfix">

                    <?php
$query = "select * from photos order by created_at desc limit 4";
$res   = mysql_query($query, $conn);
if (!$res) {
    die('Query Error : ' . mysql_error());
}
while ($photo = mysql_fetch_array($res)) {
?>
                    				<article class="portfolio-item pf-media pf-icons">
						<div class="portfolio-image">
							<a href="portfolio-single.php?index=<?php echo $photo['PHOTO_ID'];?>">
								<div style="background: url(admin/<?php echo $photo['PHOTO_URI'];?>) no-repeat ;height:300px;background-size:cover;">
							</a>
							<div class="portfolio-overlay">
								<a href="admin/<?php echo $photo['PHOTO_URI'];?>" class= "center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3><a href="portfolio-single.php?index=<?php echo $photo['PHOTO_ID'];?>"><?php echo $photo['PHOTO_TITLE'];?></a></h3>
							<span><i class="icon-calendar3"></i> <?php echo substr($photo['CREATED_AT'],0,10);?> @<?php echo $photo['PHOTO_PLACE'];?> </span>
						</div>
					</article>
                    <?php
}
?>
				</div>


				<div class="clear"></div>



				<div class="container clear-bottommargin clearfix">
					<div class="row topmargin-lg">
						<div class="heading-block center">
							<h3>Articles</h3>
						</div>
						<?php
							$query = "select * from articles ORDER BY ARTICLE_PUBLISHED_YEAR DESC, ARTICLE_PUBLISHED_MONTH DESC, ARTICLE_PUBLISHED_DAY DESC limit 4;";
							$ret = mysql_query($query, $conn);
							while($article = mysql_fetch_array($ret)){
						?>
						<div class="col-md-3 col-sm-6 bottommargin">
							<div class="ipost clearfix">
								<div class="entry-image">
									<a href="http://<?php echo $article['ARTICLE_URL'];?>">
										<div style="background: url(admin/<?php echo $article['ARTICLE_THUMBNAIL_URI'];?>) no-repeat ;height:300px;background-size:cover;"></div>
									</a>
								</div>
								<div class="entry-title">
									<h3><a href="http://<?php echo $article['ARTICLE_URL'];?>"><?php echo $article['ARTICLE_TITLE'];?></a></h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo $article['ARTICLE_PUBLISHED_YEAR']."년 ".$article['ARTICLE_PUBLISHED_MONTH']."월 ".$article['ARTICLE_PUBLISHED_DAY']."일";?></li>
								</ul>
							</div>
						</div>
						<?php } ?>


					</div>
				</div>


			</div>

		</section><!-- #content end -->

        <?php
include('footer.html');
?>
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
