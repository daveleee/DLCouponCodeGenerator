<?php
	// 쿠폰코드 발행 페이지(어드민 페이지). 쿠폰발행, 쿠폰리스트, 쿠폰사용통계 로 구성
	// 세 가지 functionality (쿠폰발행, 쿠폰리스트 보기, 통계보기) 모두 admin 에서만 허용되는 페이지라고 생각해서 하나로 묶어주는 작업 진행
 
	session_start();												// 로그인 세션 시작
	$userId = $_SESSION['userId'];									// 세션 아이디값 받을 수 있는 변수 선언
	echo "Admin page as an administrator" . "<br>";					// 현재 페이지 상태
	echo "Hi! " . $userId . "<br>=====================<br><br>";	// 세션 값 확인
	
?>		

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page only for admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
 
</head>
<body>    
    <div class="container">
    	<button onclick="window.location.href='couponPublication.php'">쿠폰 발행</button>
    	<button onclick="window.location.href='couponList.php'">쿠폰 리스트</button>
    	<button onclick="window.location.href='couponStats.php'">쿠폰 사용 통계</button>
    </div> 
</body>
</html> 