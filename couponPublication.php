<?php 
// 쿠폰 코드 발행 페이지
// 1. 쿠폰 코드는 모두 unique이며, 문자+숫자 조합이고 형식은 16자리 입니다. (****-****-****-****)
// 2. prefix 3자리를 입력 받아, 모든 쿠폰 코드의 맨 앞 3자리를 고정으로 생성 해주세요.
// 3. 쿠폰 생성 시 한번에 10만 건이 생성 되며 생성된 쿠폰은 같은 성격이 됩니다.
//     1. 예를 들어, 처음에 생성된 쿠폰은 A Group, 다음에 생성된 쿠폰은 B Group 입니다.
// 4. 쿠폰 생성 중 랜덤으로 임의의 쿠폰에는 랜덤 한 유저가 사용한 걸로 해주세요. 
// 5. 쿠폰 코드 발행 페이지는 admin 계정이 아니면 접근할 수 없는 페이지입니다.
// 6. 쿠폰 생성 로직은 직접 작성해주세요.

	session_start();																// 로그인 세션 시작
	$userId = $_SESSION['userId'];													// 세션 아이디 값 받을 수 있는 변수 선언
	echo "Coupon publication page as an administrator" . "<br>";					// 현재 페이지 상태 확인
	echo "Hi! " . $userId . "<br>=====================<br><br>";					// 세션 값 확인
	
	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');	// 데이터베이스 configuration 파일 include
?>

<!DOCTYPE html>
<html>
<head>
	<title>Coupon Publication Page for Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
 
</head>
<body>    
    <div class="container">
		<p>prefix 3자리를 입력하세요.</p> 
		<form action="couponPublicationProcess.php" method='post'>
          	<div class="form-group">  
            	<input type="text" name="prefixNum" placeholder="Prefix 3자리 입력" maxlength="3"> 
          	</div> 

          	<button type="submit"> Create Coupon </button>  
        </form>	 
    </div> 
</body>
</html> 