<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$pid=intval($_GET['pid']);	
if(isset($_POST['submit']))
{
$pname=$_POST['Hotelname'];
$ptype=$_POST['Hoteltype'];	
$plocation=$_POST['Hotellocation'];
$pprice=$_POST['Hotelprice'];	
$pfeatures=$_POST['Hotelfeatures'];
$pdetails=$_POST['Hoteldetails'];	
$pimage=$_FILES["Hotelimage"]["name"];
$sql="update tbltourhotel set HotelName=:pname,HotelType=:ptype,HotelLocation=:plocation,HotelPrice=:pprice,HotelFetures=:pfeatures,HotelDetails=:pdetails where HotelId=:pid";
$query = $dbh->prepare($sql);
$query->bindParam(':pname',$pname,PDO::PARAM_STR);
$query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
$query->bindParam(':plocation',$plocation,PDO::PARAM_STR);
$query->bindParam(':pprice',$pprice,PDO::PARAM_STR);
$query->bindParam(':pfeatures',$pfeatures,PDO::PARAM_STR);
$query->bindParam(':pdetails',$pdetails,PDO::PARAM_STR);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->execute();
$msg="Hotel Updated Successfully";
}

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Hotel Creation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
<div class="left-content">
	   <div class="mother-grid-inner">
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fa fa-angle-right"></i>Update Tour Hotel </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
  <div class="grid-form1">
  	       <h3>Update Hotel</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
						
<?php 
$pid=intval($_GET['pid']);
$sql = "SELECT * from tbltourhotel where HotelId=:pid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

							<form class="form-horizontal" name="Hotel" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hotel Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="Hotelname" id="Hotelname" placeholder="Create Hotel" value="<?php echo htmlentities($result->HotelName);?>" required>
									</div>
								</div>
<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hotel Type</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="Hoteltype" id="Hoteltype" placeholder=" Hotel Type eg- Family Hotel / Couple Hotel" value="<?php echo htmlentities($result->HotelType);?>" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hotel Location</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="Hotellocation" id="Hotellocation" placeholder=" Hotel Location" value="<?php echo htmlentities($result->HotelLocation);?>" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hotel Price in INR</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="Hotelprice" id="Hotelprice" placeholder=" Hotel Price is INR " value="<?php echo htmlentities($result->HotelPrice);?>" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hotel Features</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="Hotelfeatures" id="Hotelfeatures" placeholder="Hotel Features Eg-free Pickup-drop facility" value="<?php echo htmlentities($result->HotelFetures);?>" required>
									</div>
								</div>		


<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hotel Details</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="5" cols="50" name="Hoteldetails" id="Hoteldetails" placeholder="Hotel Details" required><?php echo htmlentities($result->HotelDetails);?></textarea> 
									</div>
								</div>															
<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Hotel Image</label>
<div class="col-sm-8">
<img src="pacakgeimages/<?php echo htmlentities($result->HotelImage);?>" width="200">&nbsp;&nbsp;&nbsp;<a href="change-image.php?imgid=<?php echo htmlentities($result->HotelId);?>">Change Image</a>
</div>
</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Last Updation Date</label>
									<div class="col-sm-8">
<?php echo htmlentities($result->UpdationDate);?>
									</div>
								</div>		
								<?php }} ?>

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Update</button>
			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
<div class="inner-block">

</div>
<?php include('includes/footer.php');?>
</div>
</div>
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
   <script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>