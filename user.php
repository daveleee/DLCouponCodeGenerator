<?php
	// 유저 페이지. 쿠폰번호 입력후 사용 (불)가능 여부 체크
	session_start();
	$userId = $_SESSION['userId'];
	echo "User page as an user" . "<br>";
	echo "Hi! " . $userId . "<br>=====================<br><br>";
	
	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');
		   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Coupon Used Check Page for users</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
 
</head>
<body>    
    <div class="container">
		<p>쿠폰번호를 입력하세요.</p> 
		<form action="userProcess.php" method='post'>
          	<div class="form-group">  
            	<input type="text" name="couponNum" placeholder="ex) aaaa1234bbbb1234" maxlength="16"> 
          	</div> 

          	<button type="submit"> 쿠폰 검색 </button>  
        </form>	 
    </div> 
</body>
</html> 