<?php
session_start();
include_once("../php/connect.php");
if (isset($_POST['nm']) && isset($_POST['flag'])){
	$a = array(	  'pc1'=> 'flag{C00kies_4r3_the_b3st}',
		          'pc2'=> 'flag{server>browser}',
		          'pc3'=> 'flag{much_cust0m_v3ry_h34der}',
		          'pc4'=> 'flag{base64_is_easy}',
		          'pc5'=> 'flag{beep-b00p}',
		          'pc6'=> 'flag{can_you_crypto}',
          );
	$b = array(	  'pc1'=> 100,
		          'pc2'=> 200,
		          'pc3'=> 300,
		          'pc4'=> 100,
		          'pc5'=> 200,
		          'pc6'=> 300,
          );
	if ($a[$_POST['nm']] === $_POST['flag']){
		$score = $b[$_POST['nm']];$email = $_SESSION['user_id'];
		$out = $conn->query("UPDATE users set score = score + $score WHERE user_id=$email;");
		if ($out === True){
			echo "Success";
		} else{
			echo "Try after some time";
		}
	}else{
		echo "fail";
	}
}else{
	echo "fail";
}
?>