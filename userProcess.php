<?php 
	// 유저 프로세스 페이지 
	// 입력받은 쿠폰번호 사용 (불)가능 여부 체크

	session_start();
	$userId = $_SESSION['userId']; 
	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');
 	
 	// POST로 받은 쿠폰 코드
 	$couponCode = $_POST['couponNum'];

	// 입력 받은 값과 tbl_cpub 의 cpub_couponCode, cpub_usedCheck 비교 
	// cpub_usedCheck 값이 1일경우 이미사용한 쿠폰. 0일경우 사용 가능한 쿠폰. 그 밖에, 유효하지않은 쿠폰.
	// 쿼리문 = select cpub_couponCode, cpub_usedCheck from comento.tbl_cpub where cpub_couponCode = 'AAA5c49f897ed019'
	$queryString = "SELECT cpub_couponCode, cpub_usedCheck from comento.tbl_cpub where cpub_couponCode = '" . $couponCode . "'";
	$result1 = mysqli_query($link, $queryString);
	while($row1 = mysqli_fetch_assoc($result1)) {             
		$usedCheck = $row1['cpub_usedCheck'] . "<br>";  
	}

	// usedCheck 값에 따라 쿠폰 사용 여부 판별. 
	switch ($usedCheck) {
		case 1:
			echo "<script> alert('이미 사용한 쿠폰입니다.');
    		location.replace('../DLCouponCodeGenerator/user.php'); </script>";  
			break;

		case 0:
			echo "<script> alert('아직 사용하지 않은 쿠폰입니다.');
    		location.replace('../DLCouponCodeGenerator/user.php'); </script>";  
			break;	
		
		default:
			echo "<script> alert('쿠폰값 오류입니다.');
    		location.replace('../DLCouponCodeGenerator/user.php'); </script>";  
			break;
	}
  
	mysql_close($link); 
?> 