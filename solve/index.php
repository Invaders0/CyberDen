y<?php
    ob_start();         // this is output buffering useful in re-directing header locations
	session_start();
	if(!(isset($_SESSION['user_id'])  && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_image']) && isset($_SESSION['signup_time'])))
		header("Location:../");
?>
<!-- HOME - READ STORIES PAGE -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title>CYBERDEN | Solve</title>
<?php
	include_once("../php/css_files.php");
?>
<style>
a {
	cursor : pointer;
}
a:hover{
	text-decoration:none;
}
.badge{
	background-color : orange;
}
.cursor {
	cursor : pointer;
}
html{
	overflow-x: hidden;
}
/*
::-webkit-scrollbar{
	width:0px;
	background:transparent;
} */
@media screen and (max-width : 765px){
	#profile_card{
		display : none;
	}
	/*
	#friends_div{
		display : none;
	} */
}
/*
@media screen and (min-width : 766px){
	#frnd_requests{
		display : none;
	}
	#stories_main_div{
		height : 510px;
		overflow-y : scroll;
	}
}
@media screen and (max-width : 1028px){
	body{
		overflow-y : scroll;
	}
	html{
		overflow-y : scroll;
	}
}*/
</style>
</head>
<body onload='review(3);'>
<!-- 										************************ navigation bar starts **********************************************						-->
<?php
	include_once("../php/header.php");
	include_once("../php/sidebar.php");
?>
<!-- 										************************ navigation bar ends   **********************************************	-->
<!-- 									*************************** stories division    ***********************************					-->
<main>
<div class='container'>
	<br />
	<div class='row'>
		<div class='col-md-5 card' style="padding:10px" >
			<h3 class="panel-heading" style="font-weight:bold"> Test My website....</h3>
			<p>  Please Test my website. Link is https://www.instinctme.com . I will give 5000 rupees and one upvote who solved it first.</p>
			<p>  Link:https://www.instinctme.com</p>
			<p>  Amount:5000/-  </p>
			<button class="btn btn-info btn-sm" id="button_1"onclick="window.location='../write/index.php?write_id=1'" onload="get_review(1)">Submit</button>
			<center><span id="review_msg_1" style="color:red"></span></center>
		</div><br /><br />
		<div class="col-md-2"></div>
		<div class='col-md-5 card' style="padding:10px" >
			<h3 class="panel-heading" style="font-weight:bold"> Pentent Test the site...</h3>
			<p>  Do Pentent Test for my website. Link is https://www.instinctme.com . I will give 5000 rupees and one upvote who solved it first.</p>
			<p>  Link:https://www.instinctme.com</p>
			<p>  Amount:5000/-  </p>
			<button class="btn btn-info btn-sm" id="button_2" onclick="window.location='../write/index.php?write_id=2'" onload="get_review(2)">Submit</button>
			<span id="review_msg_2"></span>
		</div>
	</div>
	<br />
	<div class='row'>
		<div class='col-md-5 card' style="padding:10px" >
			<h3 class="panel-heading" style="font-weight:bold"> Find the bugs in uidai website.</h3>
			<p>  Please Test my website. Link is https://uidai.gov.in/ . Government will pay the reward for every valid submission.</p>
			<p>  Link:https://uidai.gov.in/</p>
			<p>  Amount:10 lakh  </p>
			<button class="btn btn-info btn-sm" id="button_3"onclick="window.location='../write/index.php?write_id=3'" onload="get_review(3)">Submit</button>
			<center><span id="review_msg_3" style="color:red"></span></center>
		</div><br /><br />
		<div class="col-md-2"></div>
		
	</div>
	<br />
	<!--div class='row'>
		<div class='col-md-5 card' style="padding:10px" >
			<h3 style="font-weight:bold"> Test My website....</h3>
			<p>  Please Test my website. Link is https://www.instinctme.com . I will give 5000 rupees and one upvote who solved it first.</p>
			<p>  Link:https://www.instinctme.com</p>
			<p>  Amount:5000/-  </p>
			<button class="btn btn-info btn-sm">Solve</button>
		</div>
		<div class="col-md-2"></div>
		<div class='col-md-5 card' style="padding:10px" >
			<h3 class="panel-heading" style="font-weight:bold"> Pentent Test for site...</h3>
			<p>  Do Pentent Test for my website. Link is https://www.instinctme.com . I will give 5000 rupees and one upvote who solved it first.</p>
			<p>  Link:https://www.instinctme.com</p>
			<p>  Amount:5000/-  </p>
			<button class="btn btn-info btn-sm">Solve</button>
		</div>
	</div-->
</div> 
</main>
<!-- 								FOOTER SECTION STARTS  				-->
<?php
	//include_once("../php/footer.php");
?>
<!-- 								FOOTER SECTION ENDS 				-->
<!-- 					JS FILES TO LOAD FASTER   -->
<?php
	include_once("../php/js_files.php");
?>
<script>
$(document).ready(function(){
	$("#solve").addClass("active");
	get_score( <?php echo $_SESSION['user_id']; ?>);
});
// function to get the score of the user
function get_score(user_id){
	$.post("../php/get_score.php",{user_id:user_id},function(data){
		$(".score").html(data);
	});
}
</script>
<script>
new WOW().init();
</script>
<script>
function get_review(write_id){
	$.post("../php/get_review.php",{write_id:write_id},function(data){
		if(data != 0){
			$("#review_msg_"+write_id).html("Your bug is under the review");
			$("#button_"+write_id).hide();
		}
	});
}
function review(num){
	var i=1;
	for(i=1;i<=num;i++){
		get_review(i);
	}
}
</script>
</body>
</html>
	
