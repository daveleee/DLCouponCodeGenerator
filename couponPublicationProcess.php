<?php 
// 쿠폰 코드 발행 프로세스 페이지
// 1. 쿠폰 코드는 모두 unique이며, 문자+숫자 조합이고 형식은 16자리 입니다. (****-****-****-****)
// 2. prefix 3자리를 입력 받아, 모든 쿠폰 코드의 맨 앞 3자리를 고정으로 생성 해주세요.
// 3. 쿠폰 생성 시 한번에 10만 건이 생성 되며 생성된 쿠폰은 같은 성격이 됩니다.
//     1. 예를 들어, 처음에 생성된 쿠폰은 A Group, 다음에 생성된 쿠폰은 B Group 입니다.
// 4. 쿠폰 생성 중 랜덤으로 임의의 쿠폰에는 랜덤 한 유저가 사용한 걸로 해주세요. 
// 5. 쿠폰 코드 발행 페이지는 admin 계정이 아니면 접근할 수 없는 페이지입니다.
// 6. 쿠폰 생성 로직은 직접 작성해주세요.

	session_start();																// 로그인 세션 시작
	$userId = $_SESSION['userId']; 													// 세션 아이디 변수에 저장
	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');	// DB configuration 파일 include
 
	// 입력 받은 값 3자리 + 쿠폰 13자리 = 총 16자리의 쿠폰 으로 구성
	// cpub_usedCheck -> 사용유뮤 체크. 사용=1 미사용=0
	
	// 그룹명 설정. 그룹명이자 코드 앞 3자리가 된다. 
	$groupName = $_POST['prefixNum'];
	echo "group name: " . $groupName . "<br>";

	// 그룹명 중복 체크 (시간 부족으로 인한 skip)
 
 		// 실제 생성 과정을 담은 for문 
		for ($i=1; $i<=1000; $i++) { 

			// 쿠폰코드 생성(16자리)
			$couponCode = uniqid($groupName);

			// 쿠폰코드 값 (-)로 구분

			// 랜덤값 받기 $randomNum -> 쿠폰 생성 중 랜덤으로 임의의 쿠폰에는 랜덤 한 유저가 사용한 걸로 해주세요. 
    		$randomNum = rand(0,3);  

			// i 를 number in group 값으로 정의
			$numberInGroup = $i; 

    		// 쿼리스트링 설정. 데이터베이스 런타임 감소 목적
    		$queryString = "INSERT INTO tbl_cpub (cpub_groupName, cpub_numInGroup, cpub_couponCode, cpub_usedCheck, cpub_userName, cpub_usedDate) ";

    		// 랜덤값에 따라 테이블 값 삽입
    		if ($randomNum == 0) { 
				$queryString .= "values ('$groupName', '$numberInGroup', '$couponCode', '0', '', now() ) ";
				$result0 = mysqli_query($link, $queryString);  
    		} 
    		elseif ($randomNum == 1) {  
				$queryString .= "values ('$groupName', '$numberInGroup', '$couponCode', '1', 'dave lee', now() ) ";
				$result1 = mysqli_query($link, $queryString);  
    		} 
    		elseif ($randomNum == 2) {  
				$queryString .= "values ('$groupName', '$numberInGroup', '$couponCode', '1', 'kelly meyer', now() ) ";
				$result2 = mysqli_query($link, $queryString);  
    		} 
    		elseif ($randomNum == 3) {  
				$queryString .= "values ('$groupName', '$numberInGroup', '$couponCode', '1', 'ainsley redlick', now() ) ";
				$result3 = mysqli_query($link, $queryString);  
    		}  
    		else { 
    		}

    		// 팝업만 띄어준 것 처럼 보이는 효과
			echo "<script> alert('Coupon has been created.');
    		location.replace('../DLCouponCodeGenerator/admin.php'); </script>";  

		} 
     	
     	// 데이터베이스 닫기
		mysql_close($link); 
?> 