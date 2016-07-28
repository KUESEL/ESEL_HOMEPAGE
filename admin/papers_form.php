<!DOCTYPE html>
<?php
    include("config.php");
    $act = 0;
    if (array_key_exists("id", $_GET)) {
        $act = 1;
        $id = $_GET["id"];
        $res = mysql_query("select * from papers where PAPER_ID = $id", $conn);
        $row = mysql_fetch_array($res);
        $name = $row['PAPER_TITLE'];
        $desc = $row['PAPER_FULL_TEXT_LINK'];
        $degree = $row['PAPER_CATEGORY'];
        $co = $row['PAPER_AUTHORS'];
        $year = $row['PAPER_PUBLISHED_AT'];
        $lead_author = $row['STUDENT_ID'];
        $loc = $row['PAPER_BELONGS_TO'];
        $abs = $row['PAPER_ABSTRACTION'];
        $s = mysql_fetch_array(mysql_query("select STUDENT_NAME from members where STUDENT_ID=$lead_author",$conn));
    }
?>

<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    <link href="http://fonts.googleapis.com/earlyaccess/nanumpenscript.css" rel="stylesheet" type="text/css" />
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
    <script src="js/jquery-3.0.0.min.js"></script>

	<!-- Document Title
	============================================= -->
    <?php if($act == 0){?>
	<title>Paper Register</title>
    <?php }else{ ?>
	<title>Paper Edit</title>
    <?php }?>
</head>

<body class="stretched">
<script>

function validateForm() {
    var name = document.getElementById('name').value;
    var degree = document.getElementById('degree').value;
    var lead_author = document.getElementById('lead_author').value;
    var co_author = document.getElementById('co_author').value;
    var year = document.getElementById('year').value;
    var loc = document.getElementById('loc').value;
    var desc = document.getElementById('desc').value;
    var abs = document.getElementById('abs').value;

    if (name == null || name == "") {
        alert("Name must be filled out");
        return false;
    }
    else if (degree == null || degree == "") {
        alert("Degree must be filled out");
        return false;
    }
    else if (lead_author == null || lead_author == "") {
        alert("Lead author must be filled out");
        return false;
    }
    else if (co_author == null || co_author == "") {
        alert("Co-author must be filled out");
        return false;
    }
    else if (year == null || year == "") {
        alert("Published year must be filled out");
        return false;
    }
    else if (loc == null || loc == "") {
        alert("게재 장소 must be filled out");
        return false;
    }
    else if (desc == null || desc == "") {
        alert("Full text link must be filled out");
        return false;
    }
    else if (abs == null || abs == "") {
        alert("Abstract must be filled out");
        return false;
    }
    else{
        return true;
    }
}
    
function openNewWindow(url) {
  var name = '_blank';
  var specs = 'width=460px,height=573px,scrollbars=yes,menubar=no,status=no,toolbar=no';
  var newWindow = window.open(url, name, specs);
  newWindow.focus();
}

function getReturnValue(returnValue) {
    document.getElementById("lead_author").value = returnValue.id;
    document.getElementById("author").value = returnValue.name;
}
</script>

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
				<h1>Papers</h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_three_third col_last nobottommargin">

                    <?php if($act == 1){ ?>
                        <h3>Modify Now.</h3>
                    <?php }else{ ?>
                        <h3>Register Now.</h3>
                    <?php } ?>    

						<form id="register-form" name="register-form" class="nobottommargin" action="papers_insert.php" method="post" onsubmit="return validateForm()">
                            <div class="col_half">
								<label for="name">논문 제목:</label>
                                <input type="text" name="name" id="name" placeholder="Title" class="form-control" value="<?php if($act == 1) echo $name; ?>">
							</div>
							<div class="col_half col_last">
                                <label for="degree">카테고리:</label>
                                <select name="degree" id="degree" class="form-control">
                                    <?php if($act == 1){?>
                                    <option value="-1">선택해 주십시오.</option>
                                    <option value='0' <?php if($degree == 0) echo "selected";?>>국제 학술지</option>
                                    <option value='1' <?php if($degree == 1) echo "selected";?>>국내 학술지</option>
                                    <option value='2' <?php if($degree == 2) echo "selected";?>>국내 컨퍼런스</option>
                                    <option value='3' <?php if($degree == 3) echo "selected";?>>국제 컨퍼런스</option>
                                    <option value='4' <?php if($degree == 4) echo "selected";?>>특허</option>
                                    <?php }else{ ?>
                                    
                                    <option value="-1" selected disabled>선택해 주십시오.</option>
                                    <option value='0'>국제 학술지</option>
                                    <option value='1'>국내 학술지</option>
                                    <option value='2'>국내 컨퍼런스</option>
                                    <option value='3'>국제 컨퍼런스</option>
                                    <option value='4'>특허</option>
                                    <?php } ?>
                                </select>
                            </div>

							<div class="clear"></div>

                            <div class="col_full">
								<label for="lead_author">주 저자:</label>
                                <input type="text" name="author" id="author" value="<?php if($act == 1) {echo $s['STUDENT_NAME'];}?>"  readonly="readonly" class="form-control"/>
                                <input type="hidden" name="lead_author" id="lead_author" value="<?php if($act == 1) echo $lead_author; ?>"  readonly="readonly" class="form-control"/>
                                <input type="button" value="검색" onClick="openNewWindow('search_member.php');" class="form-control"/>
							</div>

							<div class="clear"></div>

                            
                            <div class="col_full">
                                <label for="co_author">공동저자 (','로 구분):</label>
                                <input type="text" name="co_author" id="co_author" value="<?php if($act == 1) echo $co; ?>" class="form-control"/>
                            </div>
							<div class="clear"></div>
                            
                            <div class="col_half">
                                <label for="year">게재년도:</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="-1" selected>선택해 주십시오.</option>
                                    <?php
                                        if($act == 0)
                                            for($i=date("Y");$i>1960;$i--) {
                                                echo "<option value='{$i}'>{$i}</option>";
                                            }
                                        else
                                            for($i=date("Y");$i>1950;$i--) {
                                                if($i != $year)
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                else
                                                    echo "<option value='{$i}' selected>{$i}</option>";
                                            }
                                        
                                    ?>
                                </select>
							</div>
                            <div class="col_half col_last">
                                <label for="loc">학술지/학회 이름:</label>
                                <input type="text" name="loc" id="loc" value="<?php if($act == 1) echo $loc; ?>" class="form-control"/>
                            </div>
                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="desc">Full Text Link:</label>
                                <input type="text" name="desc" id="desc" placeholder="Link URL" value="<?php if($act == 1) echo $desc; ?>" class="form-control"/>
							</div>
                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="abs">초록:</label>
                                <textarea rows="8" name="abs" id="abs" placeholder="Abstract" class="form-control"><?php if($act == 1) echo $abs;?></textarea>
							</div>

							<div class="clear"></div>
                            <input type="hidden" name="act" id="act" value="<?php echo $act;?>"/>
                            <?php if($act == 1){?>
                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                            <?php }?>
                            <div class="col_full nobottommargin">
								<button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register"><?php if($act == 0) echo "Register"; else echo "Modify";?></button>
							</div>
						</form>

					</div>

				</div>

			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
        <?php include('../footer.html'); ?>

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