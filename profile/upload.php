<?php
ob_start();         // this is for output buffering starts.
session_start();
if(isset($_SESSION['user_id'])){
	/*		function to compress the image starts   */
	function compress_image($source, $destination, $quality) {

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);
		imagejpeg($image, $destination, $quality);

		return $destination;
	}
	/* 		function to compress the image ends   	*/
	$check_tmp_upload = is_uploaded_file($_FILES['fileToUpload']['tmp_name']);	// to know whether the file is temporary uploaded or not
	if($check_tmp_upload){
		$target_dir = "uploads/";
		$file_name = md5($_SESSION['user_id']) . "_" . basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . $file_name;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			//echo "File is not an image.";		
			$uploadOk = 0;
		}
		/* eck if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		} */
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "size fail";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "extension fail";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			//echo "fail";
		// if everything is ok, try to upload file
		} else {
			if (compress_image($_FILES["fileToUpload"]["tmp_name"], $target_file,75)){
				include_once("../php/connect.php");
				$stmt = $conn->prepare("UPDATE users SET user_image = ? WHERE user_id = ?");
				if(!$stmt)
					die("Error at preparing statements. ". $conn->error);
				if(!$stmt->bind_param("si",$file_name,$_SESSION['user_id']))
					die("Error at binding parameters." . $stmt->error);
				if(!$stmt->execute())
					die("Error at executing." . $stmt->error);
				$_SESSION['user_image'] = $file_name;
				echo "ok";
				$stmt->close();
				$conn->close();
			} else {
				echo "fail";
			}
		}
	}else{
		echo "Something went wrong while uploading. Please try again later and please follow the instructions.";
	}
}else{
	header("Location:../");
}
?>