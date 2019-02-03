<div class="wrapper">
        <!-- Sidebar  -->
       <nav id="sidebar">
       		<div id="sibebar_content_opacity">
       		</div>
       		<div id="sidebar_content">
		        <div id="dismiss">
		            <i class="fa fa-arrow-left"></i>
		        </div>
		        <!--h3 align="center">InstinctMe</h3-->
		        <!--ul id="sidebar_list">
		            <li class="sidebar_item">HOme</li>
		            <li class="sidebar_item">SIgnup</li>
		        </ul-->
                <div id="user_div" align="center" style="border-bottom:1px solid lightblue">
                    <img src="<?php echo '../profile/uploads/'  . $_SESSION['user_image'] ; ?>" width='100px' height='100px' style='border-radius : 50%'/> 
                    <h3 class="text text-info"><b><i class="fa fa-user"></i><?php echo $_SESSION['user_name'];?></b></h3>
                </div>
                <div id="instinctme_brand" style="border-bottom: 1px solid lightblue">
                    <img src="../assets/mdb/img/instinctme.png" width="100%" height="60px" />
                </div>
                <div id="sidebar_list">
                    <ul type="none" style="width : 100%;padding:0px;margin:0px">
                        <li class="btn"><a href="../"><i class="fa fa-home"></i> Home</a></li>
                        <li class="btn"><a href="../your-story"><i class="fa fa-edit"></i> Create</a></li>
                        <li class="btn"><a href="../challs"><i class="fa fa-trophy"></i> Challenges</a></li>
                        <li class="btn"><a href="../solve"><i class="fa fa-location-arrow"></i> Solve</a></li>
                        <li class="btn"><a href="../profile"><i class="fa fa-user"></i> Profile</a></li>
                        <li class="btn"><a href="#"><i class="fa fa-bell"></i> Points<span class="badge badge-danger ml-2 score"></span></a></li>
                    </ul>
                </div>
                <div id="sidebar_logout" align="center" style="margin-top : 20px">
                    <button type="button" class="btn btn-info" onclick="window.location.href='../logout'"><a href="#" style="color:white   ">Log Out</a></button>
                </div>
            </div>
        </nav>
    </div>
