			<!--div class="card" style="padding:10px;padding-top:20px">
				<div class="user-details"  >how to fix the side div when the header is fixed while scrollin
					<div class="user-image" align="center">
						<img src="<?php echo '../profile/uploads/'  . $_SESSION['user_image'] ; ?>" alt="User-Image" title="<?php echo $_SESSION['user_name']; ?>" class="rounded-circle" width='100px' height='100px' />
					</div>
					<div class="user-info-block">
						<div class="user-heading">
							<h3 align="center"><?php echo $_SESSION['user_name']; ?></h3> 
							popover not working in firefoxpopover not working in firefox<center><span class="help-block" align='center'><?php echo $_SESSION['user_email']; ?></span></center><hr />
						</div>
						<ul class="navigation" type='none' style='margin-top:-10px'>
							<li class="active" style='width:100%'>
								<a data-toggle="tab" href="#information" style='width:100%' align='center' class="text text-aqua">
									<center><span class="fa fa-user" style='font-size:20px' align='center'> Activity</span></center>
								</a>
							</li>
						</ul>
						<div class="user-body">
							<div class="tab-content">
								<div id="information" class="tab-pane active">
									<?php
										include_once("../php/connect.php");
										$result = $conn->query("SELECT COUNT(*) as total_stories FROM stories WHERE user_id = ".$_SESSION['user_id']);
										if(!$result)
											die("Error at executing.");
										$row = $result->fetch_assoc();
										echo "<span> Stories Written : &nbsp; <b>" . $row['total_stories'] . "</b></span><br /><br />";
										$result = $conn->query("SELECT COUNT(*) as total_read FROM views WHERE user_id = ".$_SESSION['user_id']);
										if(!$result)
											die("Error at executing.");
										$row = $result->fetch_assoc();
										echo "<span> Stories  Read&nbsp;&nbsp;&nbsp; : &nbsp; <b>". $row['total_read'] ."</b></span><br /><br />";
										$result = $conn->query("SELECT COUNT(*) as total_followers FROM followers WHERE following = ".$_SESSION['user_id'] . " AND status = 1");
										if(!$result)
											die("Error at executing");
										$row = $result->fetch_assoc();
										echo "<span> Followers &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <b>". $row['total_followers'] ."</b></span><br /><br />";
										$result = $conn->query("SELECT COUNT(*) as total_following FROM followers WHERE followed_by = ".$_SESSION['user_id']." AND status = 1");
										if(!$result)
											die("Error at executing");
										$row = $result->fetch_assoc();
										echo "<span> Following &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <b>". $row['total_following'] ."</b></span><hr />";
										$conn->close();
									?>
									<center><button align='center' class='btn btn-outline-info btn-sm'>Profile</button></center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div-->