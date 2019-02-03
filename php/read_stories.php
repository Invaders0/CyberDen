<?php
session_start();
$user_id = $_SESSION['user_id'];		// current user id who is logged in
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$story_no = $_GET['story_no'];	// here story_no is there then we need to get the results of story_id less than this no. else need to get as usual i.e., starting stage.
	$category = $_GET["category"];
	if($category){
		include_once("connect.php");
		if($category == "all")
			if($story_no)
				$result = $conn->query("SELECT users.user_name, stories.* FROM users, stories WHERE (stories.valid = 1 && stories.user_id = users.user_id && stories.story_id < $story_no) ORDER by time DESC LIMIT 4");
			else
				$result = $conn->query("SELECT users.user_name, stories.* FROM users, stories WHERE (stories.valid = 1 && stories.user_id = users.user_id ) ORDER by time DESC LIMIT 4");
		else{
			if($story_no)
				$stmt = $conn->prepare("SELECT users.user_name, stories.* FROM users, stories, story_categories WHERE story_categories.category = ? AND stories.story_id = story_categories.story_id AND (stories.valid = 1 && stories.user_id = users.user_id && stories.story_id < ?) ORDER BY time DESC LIMIT 4");
			else
				$stmt = $conn->prepare("SELECT users.user_name, stories.* FROM users, stories, story_categories WHERE story_categories.category = ? AND stories.story_id = story_categories.story_id AND (stories.valid = 1 && stories.user_id = users.user_id ) ORDER BY time DESC LIMIT 4");
			if(!$stmt)
				die("Error at preparing statement.". $conn->error);
			if($story_no){
				if(!$stmt->bind_param("si",$category,$story_no))
					die("Error at binding parameters. " . $stmt->error);
			}else{
				if(!$stmt->bind_param("s",$category))
					die("Error at binding parameters." . $stmt->error);
			}
			if(!$stmt->execute())
				die("Error at executing. " .$stmt->error);
			$result = $stmt->get_result();
			$stmt->close();
		}
		if(!$result)
			die("Error at getting results. " . $stmt->error);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				/* THIS SCRIPT IS FOR READ MORE OPTION */
				$full_story = html_entity_decode($row['story']);		// this is to provide when read more clicked
				$full_story_plain = html_entity_decode($row['plain_story']);		// this is to split without errors
				$word_count = str_word_count($full_story_plain);
				$story_id = $row['story_id'];
				$story_user_id = $row['user_id'];
				if($word_count > 30){
					$preview_story = explode(" ",$full_story_plain);
					$preview_story = array_slice($preview_story,0,20);
					$preview_story = implode(" ",$preview_story);
					$read_more_story = substr($full_story,strlen($preview_story)+1);
				}else{
					$preview_story = $full_story;
					$read_more_story = "";
				}
				echo"
					<div class='card' style='padding:20px;margin-bottom:15px'>
						<div>
						<h4 style='margin-bottom:0px;padding-bottom:0px'><b>".$row['title']."</b>.</h4>
						<p style='font-size:15px;color:lightgray'>".$row['user_name']."<span style='float:right' id='$story_id"."_follow"."''><script>get_following_status($user_id,".$row['user_id'].",$story_id
)</script></span></p></div>
						<hr style='margin:0px;padding:0px'>
						</hr>
						<div class='panel-body'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span  style='display:none' id='$story_id"."_'>".$full_story."</span>
							<span id='$story_id'><br />".$preview_story."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a onclick=".'"$('."'#".$story_id."_').show();$("."'#".$story_id."').hide();$(this).hide();views($story_id,$user_id);".'"'." class='cursor' style='color:gray'>Read More</a>
						</div><hr />
						<div class='row '>
							<span class='col-sm-4' align='center'><i class='fa fa-eye text text-info'></i> &nbsp; <script>views($story_id);</script> <span id='$story_id"."_views"."'></span></span>
							<span class='col-sm-4 text text-info' align='center'>
								<span id='$story_id"."_likes_div"."'>
									<span id='$story_id"."_like"."'><script>get_like_status($user_id, $story_id);</script></span>&nbsp;
									<span id='$story_id"."_likes_count"."'><script>likes_count($story_id);</script></span>
								</span>
							</span>
							<span class='col-sm-4 p-1' align='center'>

								<a title='Is story abuse?'	data-toggle='popover'  data-html='true' data-content='<button type="."button"." class="."btn btn-sm"." onclick="."story_complaint($user_id,$story_id,$story_user_id,this)"." style="."background-color:black;color:white".">Report Us</button>'><i class='fa fa-question-circle ' style='font-size:14px;color:black'></i></a>
							</span>
						</div>
					</div>
				";
			}
			echo "
				<center><button class='btn btn-outline-info btn-sm' onclick='read_stories_more($story_id,this)'>More </button></center>
			";
		}else{
			echo "<p><center>No more posts......</center></p>";
		}
		$conn->close();		// stmt is closed above
	} 
}
