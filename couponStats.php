<?php
	// 쿠폰 사용 통계 확인 페이지.
	// 1. 각 쿠폰 그룹별로 유저들이 각각 얼만큼 사용했는지 통계를 볼 수 있는 페이지를 만들어 주세요.
	// 즉 AAA 그룹에서는 1번유저 쿠폰몇개 사용, 2번유저 쿠폰몇개 사용, 3번유저 쿠폰몇개 사용, 사용되지 않은 쿠폰 출력.
	// BBB 그룹에서는 ~ 이하생략.
 
	session_start();												// 로그인 세션 시작
	$userId = $_SESSION['userId'];									// 세션 값 변수에 저장
	echo "Statistics page as an administrator" . "<br>";			// 현재 페이지 출력
	echo "Hi! " . $userId . "<br>=====================<br><br>";	// 세션 값 출력
	
	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');	// DB Conf 파일 include

	// 그룹별 select, count, 그룹별 cpub_userName 값을 통한 유저별 쿠폰 출력.
	// ex. SELECT count(*) from comento.tbl_cpub where cpub_userName = 'dave lee' and cpub_groupName ='AAA'
	// ex. SELECT distinct cpub_groupName FROM comento.tbl_cpub 
	$arrGroup = array();	// 그룹명 출력을 위한 배열

	// 전체 그룹 1회씩만 출력해서 배열에 저장
	$sql1 = "SELECT distinct cpub_groupName from comento.tbl_cpub";	
	$result1 = mysqli_query($link, $sql1);
	while ($row1 = mysqli_fetch_assoc($result1)) { 
		array_push($arrGroup, $row1['cpub_groupName']); 
	}   
	
	$arrayCount = count($arrGroup);									// 배열에 저장된 그룹 개수
	
	echo "생성된 그룹: " . "<br><br>";									// 전체 생성된 그룹 및 통계 확인

	// for문을 통한 유저별 그룹별 쿠폰 사용 통계 출력. 시간적 여유가 된다면 리팩토링 가능
	for ($i=0; $i < $arrayCount; $i++) { 
		echo "그룹명: " . $arrGroup[$i] . "<br>"; 

		$sql2 = "SELECT count(*) from comento.tbl_cpub where cpub_groupName = '" . $arrGroup[$i] . "'";
		$sql3 = "SELECT count(*) from comento.tbl_cpub where cpub_groupName = '" . $arrGroup[$i] . "' and cpub_userName = 'dave lee' ";
		$sql4 = "SELECT count(*) from comento.tbl_cpub where cpub_groupName = '" . $arrGroup[$i] . "' and cpub_userName = 'kelly meyer' ";
		$sql5 = "SELECT count(*) from comento.tbl_cpub where cpub_groupName = '" . $arrGroup[$i] . "' and cpub_userName = 'ainsley redlick' ";
		$sql6 = "SELECT count(*) from comento.tbl_cpub where cpub_groupName = '" . $arrGroup[$i] . "' and cpub_userName = '' ";

		$result2 = mysqli_query($link, $sql2);
		$result3 = mysqli_query($link, $sql3);
		$result4 = mysqli_query($link, $sql4);
		$result5 = mysqli_query($link, $sql5);
		$result6 = mysqli_query($link, $sql6);

		$row2 = mysqli_fetch_assoc($result2);
		$row3 = mysqli_fetch_assoc($result3);
		$row4 = mysqli_fetch_assoc($result4);
		$row5 = mysqli_fetch_assoc($result5);
		$row6 = mysqli_fetch_assoc($result6);

		echo "이 그룹의 총 쿠폰수: " . $row2['count(*)'] . "<br>";
		echo "dave lee 가 사용한 쿠폰 수: " . $row3['count(*)'] . "<br>";
		echo "kelly meyer 가 사용한 쿠폰 수: " . $row4['count(*)'] . "<br>";
		echo "ainsley redlick 가 사용한 쿠폰 수: " . $row5['count(*)'] . "<br>";
		echo "이 그룹의 사용되지 않은 쿠폰 수: " . $row6['count(*)'] . "<br><br>";

	}

 	// 데이터베이스 닫기
	mysql_close($link); 
?>		 