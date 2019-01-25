<?php
	// 로그인 유효성 체크 해 주는 페이지
	session_start();
	
	$userId = trim($_POST['inputId']);
	$userPw = trim($_POST['inputPw']);

  	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');


	// ID input check
	if(empty($userId) || empty($userPw)) {
		echo "<script> alert('Please enter your email or password.'); history.back(); </script>"; 
	}

	else {	
		// ID valid check from database
		$sql1 = "SELECT count(*) as count FROM comento.tbl_user WHERE user_id='$userId' AND user_pw='$userPw'";
		$result1 = mysqli_query($link, $sql1);
		$row1 = mysqli_fetch_assoc($result1);

		if($row1['count'] > 0) {

			// Success to login
			$sql2 =  "SELECT * FROM comento.tbl_user";
			$_SESSION['userId'] = $userId;
 
			
			// In the case of admin -> admin page
			if ($_SESSION['userId'] == 'admin') {
				echo "<script> top.location.href = 'admin.php'; </script>"; 

			}
			
			// In the case of users -> user page
			else {

				echo "<script> top.location.href = 'user.php'; </script>"; 
			}			

 
		}

		else {	

			// Failed to login (Wrong email or password. Try again.)
			echo "<script> alert('Wrong ID or password. Try again.'); history.back(); </script>";  
		}

	} 
	mysqli_close($conn);	//DB disconnect 
?> 