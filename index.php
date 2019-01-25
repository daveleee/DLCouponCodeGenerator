<?php
// 시작 페이지
// 1. 로그인 페이지에서 id, password를 입력해서 로그인을 성공하면 페이지가 이동됩니다.
//     1. admin 계정은 '쿠폰 코드 발행 페이지' 로 이동합니다.
//     2. 그 외의 계정은 '쿠폰 코드 사용 페이지' 로 이동합니다.
  	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');		// 데이터베이스 conf 파일 포함
	
	echo "<br>" . "This is index page" . "<br>";										// 현재페이지 상태 출력
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
 
</head>
<body>  
	<br><br><br>
	<h1 style="text-align: center; font-size: 20px; font-weight: bold;">SIGN IN TO DLCoupon Code Generator</h1>
	<br> 
        <div class="container">
 
            <form action='loginCheck.php' method='post' style="text-align: center;">
              	<div class="form-group"> 
                	<center><input type="text" class="form-control" name="inputId" id="inputId" placeholder="ID"></center>
              	</div>
              
              	<div class="form-group"> 
                	<center><input type="password" class="form-control" name="inputPw" id="inputPw" placeholder="Password"></center>
              	</div>
              	
              	<button type="submit" id="login" style="margin-top: 20px;"> LOG IN </button>  
            </form>	 
        </div> 
</body>
</html> 