<?php
    ob_start();             // this is for output buffering for redirecting pages using header() function
	session_start();
	if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])))
		header("Location:../");
?>
<!-- YOUR STORY PAGE -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title>CYBERDEN | Create</title>
<?php
	include_once("../php/css_files.php");
?>
<style>
.badge{
	background-color : orange;
}
@media screen and (min-width : 766px){
	#frnd_requests{
		display : none;
	}
}
</style>
</head>
<body style="background:#fafafa!important">
<!-- 												NAVIGATION BAR 	STARTS						-->
<?php
	include_once("../php/header.php");
	include_once("../php/sidebar.php");
?>
<!-- 												NAVIGATION BAR ENDS 						-->

<div class='container' style='margin-top : 20px;'>
	<div class='row'>
		<div class='alert alert-success alert-dismissable wow bounceInLeft'>
			<a href='#' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
			<strong>CYBERDEN</strong> seeks users to create challenges which  make other users think and which can enhance their cyber crime skills.  Your challenge must have the answer and should help solvers to enhance their skills. <br />
		</div>
	</div>
</div>
<div class='container'>
	<div class='row'>
		<div class='col-sm-9'>
			<div class='page-header'>
				<h3>Post your Challenge here ...</h3>
			</div>
			<div class='form'>
				<div class="md-form form-sm">
					<i class="fa fa-edit prefix"></i>
					<input id="title" type="text" class="form-control" name="title" style="width:300px"/>
					<label for="title" data-error="wrong" data-success="right">Challege Title</label>
				</div>
				<div class='form-inlin'>
					<label for='category' >Select Categories  : </label>
					<select name='category' id='category' multiple="multiple">
						<option value="crypto">Crypto</option>
						<option value="web">Web</option>
						<option value="pwn">Binary Exploitation</option>
						<option value="re">Reverse Engineering</option>
						<option value="forensics">Forensics</option>
						<option value="misc">Misc</option>
						<option value="pro">Programming</option>
						<option value="recon">Recon</option>
						<option value="others">Others</option>
					</select>
				</div><br />
				<textarea name='user_story' id="user_story" class='form-control wow bounceInRight' placeholder='Write Your story here......'></textarea>
				<br />
				 <!--div class='form-inline'>
					<div class="radio">
						<label><input type="radio" id='story_type' name='story_type' value='own' checked> &nbsp;&nbsp;My Own Challege</label>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="radio">
						<label><input type="radio" id='story_type' name='story_type' value='others'>  &nbsp;&nbsp;Other's Challenge</label>
					</div>
				 </div-->
				 <div class='checkbox'>
					<label><input type='checkbox' id="agree" name='agree' value='yes' /> <strong>I agree to terms and conditions of CYBERDEN</strong></label>
				 </div>
				 <br />
				 <div class='col-sm-3'><button type='button' class='btn btn-info' onclick='your_story()'>Submit</button></div>
				 <div class='col-sm-9'><p id='user_story_msg'><!-- this is for msg after sending --></p></div>
			</div>
		</div>
		<div class='col-sm-3'><br /><br />
			<h3 class="page-heading">Updates....</h3>
		</div>
	</div>

</div>
<br />
<!-- 								FOOTER SECTION STARTS  				-->
<?php
	//include_once("../php/footer.php");
?>
<!-- 								FOOTER SECTION ENDS 				-->
<!-- js files to load faster   -->
<?php
	include_once("../php/js_files.php");
?>
<script type='text/javascript'>
	tinymce.init({
		selector : 'textarea', // note the comma at the end of line !
		height : 250,
		branding : false,
		browser_spellcheck: true,
		encoding : 'xml',
	});
	new WOW().init();
</script>
<script>
$(document).ready(function(){
	$("#your-story").addClass("active");
	notifications_count();
	$("#category").multiselect();
	get_score( <?php echo $_SESSION['user_id']; ?>);
}
);
// function to get the score of the user
function get_score(user_id){
	$.post("../php/get_score.php",{user_id:user_id},function(data){
		$(".score").html(data);
	});
}
</script>
<!-- SCRIPT FOR your_story() function -->
<script>
function your_story(){
	var title = $("#title").val();
	var category_arr = $("#category").val();
	var user_story = tinymce.activeEditor.getContent();
	var user_story_plain = tinymce.activeEditor.getContent({ format: 'text' });
	//alert(user_story_plain.split(" ").length);
	//var story_type = $("input[name='story_type']:checked").val();
	if($("#agree").is(":checked")){
		if(title && category && user_story && (user_story_plain.split(" ").length >= 25) && category_arr.length >0){
			$("#user_story_msg").html("<img src='../assets/images/loading3.gif' width='100px' height='100px' style='margin:-40px' />");
			$.post("../php/your_story.php",{title : title, category_arr : category_arr, story : user_story, plain_story : user_story_plain, story_type : 'own'},function(data){
				if(data == "fail"){			// these are known from the your_story.php file`
					$("#user_story_msg").html("<b>Enter valid data. You need to fill out all the fields.</b>"); 
				}else if(data == "Already existed story"){			// these are known from the your_story.php file`
					$("#user_story_msg").html("<b>Sorry! Story already existed. Please try with new one.</b>");
				}else if(data == "too short"){						// these are known from the your_story.php file
					$("#user_story_msg").html("<b>Your story is too short to accept. Please try again later.</b>");
				}else if(data == "success"){			// these are known from the your_story.php file`
					$("#user_story_msg").html("<b>Congrats! Your Story has posted successfully.....</b>");
				}else{
					$("#user_story_msg").html(data);
				}
			});
			
		}else if(title && category && user_story  && (user_story.split(" ").length < 25)){
			$("#user_story_msg").html("<b>Your story is too short to accept. Please try again later.</b>");
		}else{
			$("#user_story_msg").html("<b>Please fill out all the fields...</b>");
		}
	}else{
		$("#user_story_msg").html("<b>Please agree to the terms and conditions of InstinctMe</b>");
	}
}
function friend_requests_count(){			// to count the friend requests		
	$.get("../php/friend_requests_count.php",function(data){
		if(data == 0)
			$(".fnd_req_count").html("");
		else if (data > 0){
			$(".fnd_req_count").html(data);
		}
	});
}
function notifications_count(){				// this is to count the notifications to current users which are unseen
	$.get("../php/notifications_count.php",function(data){
		if(data > 0){
			$(".notifications_indicator").html("<span style='color:orange;font-size:20px'><b>*</b></span>");
			$(".notifications_count").html(data);
		}
	});
}
</script>
</body>
</html>
