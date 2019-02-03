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

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
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
<body>
	<br /><br /><br />
	<?php
		include_once("../php/connect.php");
		$result = $conn->query("SELECT user_name, score from users where score <> 0 ORDER BY score DESC");
		if(!$result)
			die("Error at getting results.");
		if($result->num_rows > 0){
			echo "<table border='1' id='customers' align='center' style='width:60%'><tr><th>Name</th><th>Score</th><th>Badge</th></tr>";
			while($row=$result->fetch_assoc()){
				echo"	
					<tr><td>".$row['user_name']."</td><td>".$row['score']."</td><td>Noob</td></tr>
				";
				
			}
			echo"</table>";
		}else{
			echo "No user submissions....";
		}
		$conn->close();
	?>
</body>
<script>
$(document).ready(function(){
	$("#scoreboard").addClass("active");
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


</script>
</body>
</html>
	
