<?php
    ob_start();         // this is output buffering useful in re-directing header locations
	session_start();
	if(!(isset($_SESSION['user_id'])  && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) && isset($_SESSION['user_image']) && isset($_SESSION['signup_time'])))
		header("Location:../");
?>
<!-- HOME - READ STORIES PAGE -->
<!DOCTYPE html>
<html lang='en'>
<head>
<title>CYBRERDEN | Home</title>
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
<body onload='read_stories()'>
<!-- 										************************ navigation bar starts **********************************************						-->
<?php
	include_once("../php/header.php");
	include_once("../php/sidebar.php");
?>
<!-- 										************************ navigation bar ends   **********************************************	-->
<!-- 									*************************** stories division    ***********************************					-->
<div class='container'>
	<div class='row'>
		<div class='col-md-3' id='profile_card' style='margin-top:15px'>
			<div class="card"id="category_list" style="position:fixed;width:17%;height : 50%;border:1px solid lightblue">
				<h4 class="page-header text-center" style="margin-top:8px">Cyber Categories </h4>
				<div id="category_items" style="overflow-y:auto;overflow-x:auto">
					<ul type="none" style="margin:0px;padding:10%;padding-top: 20px">
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="all" name="category" value="all" onchange="read_stories()" checked>
              				<label class="custom-control-label cursor" for="all">All</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="crypto" name="category" value="crypto" onchange="read_stories()"">
              				<label class="custom-control-label cursor" for="crypto">Crypto</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="web" name="category" value="web" onchange="read_stories()"">
              				<label class="custom-control-label cursor" for="web">Web</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="pwn" name="category" value="pwn" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="pwn">Binary Exploitation</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="re" name="category" value="re" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="re">Reverse Engineering</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="forensics" name="category" value="forensics" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="forensics">Forensics</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="misc" name="category" value="misc" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="misc">Misc</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="pro" name="category" value="pro" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="pro">Programming</label>
           				 </div>
						</li>
						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="recon" name="category" value="recon" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="recon">Recon</label>
           				 </div>
						</li>						<li>
						  <div class="custom-control custom-radio">
              				<input type="radio" class="custom-control-input" id="others" name="category" value="others" onchange="read_stories()">
              				<label class="custom-control-label cursor" for="others">Others</label>
           				 </div>
						</li>
					</ul>
				</div>
				<!--center><button type="button" class="btn btn-outline-info waves-effect" id="category_button" style="padding:5px;margin:0px;margin-bottom: 2px">Proceed <i class="fa fa-arrow-right"></i></button></center-->
			</div>
		</div>
		<div class='col-md-0'></div>
		<div class='col-md-8' >
			<div id='stories_main_div'>
				<br />
				<div id='stories_div' ></div>
			</div>
		</div>
	</div>
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
new WOW().init();
</script>
<script>
$(document).ready(function(){
	$("#home").addClass("active");
	get_score( <?php echo $_SESSION['user_id']; ?>);
	notifications_count();
	// this is to show sidebar in mobile
	//$('[data-toggle="popover"]').popover(); 
	$("[data-toggle='popover']").popover({ trigger: "manual" , html: true, animation:false})
	    .on("mouseenter", function () {
	        var _this = this;
	        $(this).popover("show");
	        $(".popover").on("mouseleave", function () {
	            $(_this).popover('hide');
	        });
	    }).on("mouseleave", function () {
	        var _this = this;
	        setTimeout(function () {
	            if (!$(".popover:hover").length) {
	                $(_this).popover("hide");
	            }
	        }, 300);
	});
}
);
</script>
<!-- script to call the read_stories() function that fetches the stories posted by users  -->
<script>
// function to get the score of the user
function get_score(user_id){
	$.post("../php/get_score.php",{user_id:user_id},function(data){
		$(".score").html(data);
	});
}
// function to get the stories from the read_stories.php    
function read_stories(story_no){
	story_no = story_no || 0;			// default value is 0
	var category  = $("input[name='category']:checked").val();
	//var category = $("#category").val();
	if(category){
		$("#stories_div").html("<center><i class='fa fa-circle-o-notch fa-spin' style='color:black;font-size:30px'></i></center>");
		$.get("../php/read_stories.php",{story_no : story_no, category : category}, function(data){
			$("#stories_div").html(data);
		});
	}
}
// function to get the more soties when more button is pressed
function read_stories_more(story_no,id){
	story_no = story_no || 0;
	$(id).html("Loading...");
	var category = $("input[name='category']:checked").val();
	if(category){
		$.get("../php/read_stories.php",{story_no : story_no, category : category}, function(data){
			$(id).hide();
			$("#stories_div").append(data);
		});
	}
}
//function to get the following status
function  get_following_status(followed_by, following, story_id){
	if(followed_by && following && story_id){
		$.post("../php/get_following_status.php",{followed_by: followed_by, following : following},function(data){
			if(data == "not_following_yet"){
				$("#"+story_id+"_follow").html("<span class='cursor' onclick='follow("+followed_by+", "+following+", "+-1+","+story_id+")'><b><i class='fa fa-rss'></i> Follow</b></span>");
			}else if(data == "not_following"){
				$("#"+story_id+"_follow").html("<span class='cursor' onclick='follow("+followed_by+", "+following+", "+0+","+story_id+")'><b><i class='fa fa-rss'></i> Follow</b></span>");
			}else if(data == "following"){
				$("#"+story_id+"_follow").html("<span class='cursor' onclick='follow("+followed_by+", "+following+", "+1+","+story_id+")'><i class='fa fa-rss-square'></i> Following</span>");
			}else{
				$("#"+story_id+"_follow").html(data);
			}
		});
	}
}
// function to follow the story_user and unfollow depending on the current status
function follow(followed_by, following, current_status, story_id){
	if(followed_by && following && story_id && (current_status == 0 || current_status == 1 || current_status == -1)){
		$("#"+story_id+"_follow").html("<span><i class='fa fa-circle-o-notch'></i></span>");
		$.post("../php/follow.php",{followed_by : followed_by, following : following, current_status : current_status}, function(data){
			if(data == "ok" && (current_status == -1 || current_status == 0)){
				$("#"+story_id+"_follow").html("<span class='cursor' onclick='follow("+followed_by+", "+following+", "+1+", "+story_id+")'><i class='fa fa-rss-square'></i> Following</span>");
			}
			else if(data == "ok" && current_status == 1){
				$("#"+story_id+"_follow").html("<span class='cursor' onclick='follow("+followed_by+", "+following+","+0+","+ story_id+")'><b><i class='fa fa-rss'></i> Follow</b></span>");
			}else{
				$("#"+story_id+"_follow").html(data);
			}
		});
	}
}
// fucntion to get the like status
function get_like_status(user_id,story_id){
	if(user_id && story_id){
		$("#"+story_id+"_like").html("<i class='fa fa-spinner fa-spin' style='font-size:25px'></i> ");
		$.post("../php/get_like_status.php",{user_id: user_id, story_id : story_id},function(data){
			if(data == "not_liked_yet"){
				$("#"+story_id+"_like").html("<span class='cursor' style='font-size:25px' onclick='like("+user_id+", "+story_id+", "+-1+")'><i class='fa fa-thumbs-o-up'></i> </span>");
			}else if(data == "not_liked"){
				$("#"+story_id+"_like").html("<span class='cursor' style='font-size:25px' onclick='like("+user_id+", "+story_id+", "+0+")'><i class='fa fa-thumbs-o-up'></i></span>");
			}else if(data == "liked"){
				$("#"+story_id+"_like").html("<span class='cursor' style='font-size:25px' onclick='like("+user_id+", "+story_id+", "+1+")'><i class='fa fa-thumbs-up'></i></span>");
			}else{
				$("#"+story_id+"_like").html(data);
			}
		});
	}
}
// function to like the story
function like(user_id, story_id, current_status){
	if(user_id && story_id && (current_status == 0 || current_status == 1 || current_status == -1)){
		//$("#"+story_id+"_like").html("<center><img src='../assets/images/loading3.gif' width='30px' height='40px' style='margin:0px' /></center>");
		var query = false;
		$("#"+story_id+"_likes_div").html("<i class='fa fa-spinner fa-spin' style='font-size:35'></i> ");
		$.post("../php/like.php",{user_id : user_id, story_id : story_id, current_status : current_status}, function(data){
			if(data == "ok" && (current_status == -1 || current_status == 0)){
				$("#"+story_id+"_likes_div").html("<span id='"+story_id+"_like'><span class='cursor' style='font-size:25px' onclick='like("+user_id+", "+story_id+", "+1+")'><i class='fa fa-thumbs-up'></i></span></span>&nbsp;&nbsp;<span id='"+story_id+"_likes_count'>"+likes_count(story_id)+"</span>");
			}
			else if(data == "ok" && current_status == 1){
				$("#"+story_id+"_likes_div").html("<span id='"+story_id+"_like'><span class='cursor' style='font-size:25px' onclick='like("+user_id+", "+story_id+","+0+")'><i class='fa fa-thumbs-o-up'></i></span></span>&nbsp;&nbsp;<span id='"+story_id+"_likes_count'>"+likes_count(story_id)+"</span>");
			}else{
				$("#"+story_id+"_likes_div").html(data);
			}
		});
	}
}
// function to get the no of likes to each story

function likes_count(story_id){
	if(story_id){
		$.post("../php/likes_count.php",{story_id  : story_id},function(data){
			if(parseInt(data) >= 0){
				$("#"+story_id+"_likes_count").html(data);
			}else{
				$("#"+story_id+"_likes_count").html(data);
			}
		});
	}
	return "";
}
// function to update the views and get the total number of views from the views.php
function views(story_id, user_id){
	user_id = user_id || "";
	if(!user_id)
		$("#"+story_id+"_views").html("...");
	$.post("../php/views.php", {story_id : story_id, user_id : user_id},function(data){
		if(data != "Already viewed")
			$("#"+story_id+"_views").html(data);
	});
}

function notifications_count(){				// this is to count the notifications to current users which are unseen
	$.get("../php/notifications_count.php",function(data){
		if(data > 0){
			//$(".notifications_indicator").html("<span style='color:orange;font-size:20px'><b>*</b></span>");
			$(".notifications_count").html(data);
		}
	});
}
function story_complaint(user_id, story_id, story_user_id,id){			// id is this
	$(id).html("processing...");
	if(user_id && story_id && story_user_id){
		$.post("../php/story_complaint.php",{user_id : user_id, story_id : story_id, story_user_id : story_user_id},function(data){
			if(data == "ok"){
				$(id).html("Success...");
				$(id).hide(1000);
			}else{
				$(id).html(data);
			}
		});
	}
}

</script>
</body>
</html>
	
