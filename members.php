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
	<title> ESEL HOMEPAGE - 연구실을 만들어가는 사람들</title>

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
            
            
        
		<section id="page-title" class="page-title-parallax page-title-dark" style="padding: 250px 0; background-image: url('members/background2.jpg'); background-size: cover; background-position: center center;" data-stellar-background-ratio="0.4">

			<div class="container clearfix">
				<h1>ESEL을 만들어가는 사람들</h1>
				<!-- <span>오늘도 불철주야 연구밖에 모르는 바보.. 넌 바보야!</span> -->
                			

			</div>

		</section>

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_third">

						<div class="heading-block fancy-title nobottomborder title-bottom-border">
							<h4>OUR <span>VISION</span>.</h4>
						</div>

						<p><b>
							1. ESEL의 연구원들은 노력을 혁신으로 만듭니다.<br/>
							2. ESEL의 연구원들은 자기 계발을 위해 노력합니다.<br/>
							3. ESEL의 연구원들은 서로 돕습니다.
						</b></p>

					</div>

					<div class="col_one_third">

						<div class="heading-block fancy-title nobottomborder title-bottom-border">
							<h4>OUR <span>MISSION</span>.</h4>
						</div>

						<p><b>ESEL의 연구원들은 인호 교수님의 지도 아래에서 열심히 연구하여 소프트웨어 공학 분야를 주도하는 인재로 도약하는 것을 목표로 합니다. </b></p>

					</div>

					<div class="col_one_third col_last">

						<div class="heading-block fancy-title nobottomborder title-bottom-border">
							<h4>Key<span>Words</span>.</h4>
						</div>

						<p class="center">
							<b>자유(Freedom)</b><br/>
							<b>노력(Effort)</b><br/>
							<b>혁신(Innovation)</b><br/>
						</p>
						

					</div>

				</div>

				<div class="section nomargin">
					<div class="clear"></div>

					<div class="heading-block center">
                        <br/>
                        <br/>
                        <br/>
						<h4>재학생</h4>
					</div>
				</div>

                <?php
                    $query = "select * from members order by STUDENT_NUMBER";
                            $res = mysql_query($query, $conn);
                            if (!$res) {
                                die('Query Error : ' . mysql_error());
                            }
                    $index= 0;
                    while($row = mysql_fetch_array($res)){
                        if($row['DEGREE'] != 2 && $row['DEGREE'] != 4 ){
                                    switch($row['DEGREE']){
                                        case 0 : $degree = "연구 교수"; break;
                                        case 1 : $degree = "박사 과정"; break;
                                        case 2 : $degree = "박사 졸업"; break;
                                        case 3 : $degree = "석사 과정"; break;
                                        case 4 : $degree = "석사 졸업"; break;
                                        case 5 : $degree = "인턴 | 학부연구생"; break;
                                        case 6 : $degree = "석박통합과정"; break;
                                        default : $degree = ""; break;
                                    }
                        if($index%2 == 0){
                ?>
                
				<div class="row common-height clearfix">

					<div class="col-sm-5 col-padding" style="background: url('admin/<?php echo $row['PROFILE_PHOTO_URI'];?>') center center no-repeat; background-size: cover;"></div>

					<div class="col-sm-7 col-padding">
						<div>
							<div class="heading-block">
								<span class="before-heading color"><strong><?php echo $degree;?></strong></span>
								<h3><?php echo $row['STUDENT_NAME'];?></h3>
                                <!-- <?php echo $row['STUDENT_NUMBER'];?> -->
							</div>

							<div class="row clearfix">

								<div class="col-md-6">
									<p><?php echo $row['DESCP'];?></p>

								</div>

								<div class="col-md-6">
									<ul class="skills">
										<li data-percent="80">
											<span>Wordpress</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="80" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="60">
											<span>CSS3</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="60" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="90">
											<span>HTML5</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="90" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="70">
											<span>jQuery</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="70" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="85">
											<span>Ruby</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="85" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
									</ul>
								</div>

							</div>

						</div>
					</div>

				</div>
                <?php
                        }
                        else{
                ?>
				<div class="row common-height clearfix">

					<div class="col-sm-7 col-padding" style="background-color: #F5F5F5;">
						<div>
							<div class="heading-block">
								<span class="before-heading color"><strong><?php echo $degree; ?></strong></span>
								<h3><?php echo $row['STUDENT_NAME'];?></h3>
                                <!-- <?php echo $row['STUDENT_NUMBER'];?> -->
							</div>

							<div class="row clearfix">

								<div class="col-md-6">
									<p><?php echo $row['DESCP'];?></p>

								</div>

								<div class="col-md-6">
									<ul class="skills">
										<li data-percent="80">
											<span>Wordpress</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="80" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="60">
											<span>CSS3</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="60" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="90">
											<span>HTML5</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="90" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="70">
											<span>jQuery</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="70" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
										<li data-percent="85">
											<span>Ruby</span>
											<div class="progress">
												<div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to="85" data-refresh-interval="30" data-speed="1100"></span>%</div></div>
											</div>
										</li>
									</ul>
								</div>

							</div>

						</div>
					</div>

					<div class="col-sm-5 col-padding" style="background: url('admin/<?php echo $row['PROFILE_PHOTO_URI'];?>') center center no-repeat; background-size: cover;"></div>

				</div>
                <?php
                        }
                            
                    $index++;
                        }
                    }
                ?>
				<div class="container clearfix">

					<div class="clear"></div>

					<div class="heading-block center">
                        <br/>
                        <br/>
                        <br/>
						<h4>졸업생</h4>
					</div>


					<?php
                    $query = "select * from members order by GRADUATE_YEAR DESC";
                            $res = mysql_query($query, $conn);
                            if (!$res) {
                                die('Query Error : ' . mysql_error());
                            }
                    $index= 0;
                    while($row = mysql_fetch_array($res)){
                        if($row['DEGREE'] == 2 || $row['DEGREE'] == 4 ){
                                    switch($row['DEGREE']){
                                        case 2 : $degree = "박사 졸업"; break;
                                        case 4 : $degree = "석사 졸업"; break;
                                        default : $degree = ""; break;
                                    }
                ?>

                <div class="col-md-3 col-sm-6 bottommargin">

                    <div class="team">
                        <div class="team-image">
                            <a href="portfolio-single.php?index=<?php echo $row['STUDENT_ID'];?>">
                            	<!-- <div style="background: url(admin/<?php echo $member['PHOTO_URI']?>) no-repeat;height:300px;background-size:cover"> -->
                                <img  style="background: url(admin/<?php echo $row['PROFILE_PHOTO_URI']?>) no-repeat; height: 300px; background-size:cover">
                            </a>
                        </div>
                        <div class="team-desc team-desc-bg">
                                    <div class="team-title"><h4><?php echo $row['STUDENT_NAME'];?></h4><span><strong><?php echo $degree;?></strong></span></div>
                        </div>
                    </div>

                </div>


                    <?php
                        $index++;
                            }
                        }
                    ?>


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