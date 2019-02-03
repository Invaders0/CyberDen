<?php
session_start();
include_once("../php/connect.php");
if (isset($_POST['nm']) && isset($_POST['flag'])){
	$a = array(	  'pc0'=> 'flag{base64_is_easy}',
		          'pc1'=> 'flag{beep-b00p}',
		          'pc2'=> 'flag{can_you_crypto}',
		          'pc3'=> 'flag{C00kies_4r3_the_b3st}',
		          'pc4'=> 'flag{server>browser}',
		          'pc5'=> 'flag{much_cust0m_v3ry_h34der}',
          );
	$b = array(	  'pc1'=> 100,
		          'pc2'=> 200,
		          'pc3'=> 300,
		          'pc4'=> 100,
		          'pc5'=> 200,
		          'pc6'=> 300,
          );
	$nm = $_POST['nm'];
	$flag =  $_POST['flag'];

	if ($a[$nm] === $flag){
		$score = $b[$nm];$email = $_SESSION['user_id'];
		$out = $conn->query("UPDATE users set score = score + $score WHERE user_id=$email;");
		if ($out === True){
			echo "Success";
		} else{
			echo "Try after some time";
		}
	}else{
		echo "fail1";
	}
}else{
	echo "fail";
}
?>