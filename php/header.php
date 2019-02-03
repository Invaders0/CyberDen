<nav class="navbar fixed-top navbar-expand-lg navbar-dark ">

 <div class="container">
  <a class="navbar-brand px-lg-4 mr-0 btn btn-outline-info" href="#">
     <span style="font-weight:bold;font-style:20px">CYBERDEN</span>
    </a>
  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" >
   <span class="navbar-toggler-icon" id="sidebarCollapse" style="background-color:lightblue!important"></span>
  </button>
  <!-- Collapsible content -->
  <div class="collapse navbar-collapse justify-content-end font-weight-bold" id="collapse_div">

    <!-- Navbar brand -->
    <ul class='nav navbar-nav navbar-right '>
		<li  style='margin-left:30px;margin-right:30px'><a id='home' href="../home" class="text text-info" ><i class='fa fa-home ' style='font-size:25px;'></i> Home</a></li>
		<li  style='margin-right:30px'><a id='your-story' href="../your-story" class="text text-info"><i class='fa fa-edit' style='font-size:25px;'></i> Create</a></li>
		<li  style='margin-right:30px'><a id='notifications' href='../challs/index.php' class="text text-info"><i class='fa fa-trophy' style='font-size:25px;'></i>      Challenges<sup><span class='badge notifications_count'></span></sup></a></li>
		<li  style='margin-right:30px'><a id='solve' href="../solve" class="text text-info"><i class='fa fa-location-arrow' style='font-size:25px;'></i> Bug Bounty</a></li>
		<li  style='margin-right:30px'><a id='points' href="#" class="text text-info"><i class='fa fa-check' style='font-size:25px;'></i> Points<span class="badge badge-danger ml-2 score"></span></a></li>
		<li class='nav-item dropdown' style='margin-top:0px'>	<!-- USER PROFILE dropdown -->
			<a href='#' class="dropdown-toggle text text-info" data-toggle='dropdown'><img src="<?php echo '../profile/uploads/'  . $_SESSION['user_image'] ; ?>" width='30px' height='30px' class='img img-circle' style='padding:0px;margin:0px;border-radius : 50%'/> &nbsp;<span><?php echo $_SESSION['user_name'];?></span><span class='notifications_indicator'></span><i class="fa fa-caret-down"></i></a>
			<div class='dropdown-menu' style="padding:0px!important">
				<a href='../profile' class="text text-info dropdown-item"><i class='fa fa-user'></i> Profile</a>
				<a href="#" class="text text-info dropdown-item"><i class='fa fa-gift'></i> Rewards<span class="badge badge-danger">0</span></a-->
				<a href='../logout' class="text text-info dropdown-item"><i class='fa fa-sign-out'> Logout</i></a>
			</ul>
		</li>
	</ul>

   </div>

</nav>
