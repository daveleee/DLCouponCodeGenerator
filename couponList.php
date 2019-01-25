<?php
	// 쿠폰 리스트 테이블 페이지.
	// 1. 쿠폰 코드를 100개씩, 페이징처리
	// 2. 그룹별 검색 가능
	// 3. 코드와 코드 사용일시, 코드 사용 유저 출력.
 
	session_start();																// 로그인 세션
	$userId = $_SESSION['userId'];													// 세션값 변수에 저장
	echo "Coupon list page as an administrator" . "<br>";							// 현재 페이지 출력
	echo "Hi! " . $userId . "<br>=====================<br><br>";					// 현재 세션 출력
	
	require_once($_SERVER["DOCUMENT_ROOT"] . '/DLCouponCodeGenerator/dbConf.php');	// 데이터베이스 파일 인클루드
 

	// 페이징 시작 

    if(isset($_GET['page'])) {												// 페이지 get 변수가 있으면 받아오고, 없다면 1페이지 보이기
    	$page = $_GET['page'];
    } 
      
    else {
    	$page = 1;
    }
    
    // 전체 게시글 받아오기 위한 쿼리  
	$sql = "SELECT count(*) as cnt from comento.tbl_cpub order by cpub_no desc";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	$allPost = $row['cnt'];													//전체 게시글의 수

	$onePage = 10;															// 한 페이지에 보여줄 게시글의 수
	$allPage = ceil($allPost / $onePage); 									// 전체 페이지의 수
       
    $oneSection = 10; 														// 한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20)
	$currentSection = ceil($page / $oneSection); 							// 현재 섹션
	$allSection = ceil($allPage / $oneSection); 							// 전체 섹션의 수

	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); 		//현재 섹션의 처음 페이지

	if($currentSection == $allSection) {									// 현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지로 설정
		$lastPage = $allPage; 
	} 

	else {																	//현재 섹션의 마지막 페이지
		$lastPage = $currentSection * $oneSection; 
	}

	$prevPage = (($currentSection - 1) * $oneSection); 						//이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); 	//다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

	$paging = '<a>'; 														// 페이징을 저장할 변수

	if($page != 1) { 														//첫 페이지가 아니라면 처음 버튼을 생성
		$paging .= '<a href="../DLCouponCodeGenerator/couponList.php?page=1"> 처음 </a>';
	}

	if($currentSection != 1) { 												//첫 섹션이 아니라면 이전 버튼을 생성
		$paging .= '<a href="../DLCouponCodeGenerator/couponList.php?page=' . $prevPage . '"> 이전 </a>';
	}

	for($i = $firstPage; $i <= $lastPage; $i++) {							// 페이지 넘버 배치
		if($i == $page) {
  			$paging .= '<a>' . $i . ' </a>';
		} 

		else {
  			$paging .= '<a href="../DLCouponCodeGenerator/couponList.php?page=' . $i . '">' . $i . ' </a>';
		}
	}

	if($currentSection != $allSection) { 									// 마지막 섹션이 아니라면 다음 버튼을 생성
		$paging .= '<a href="../DLCouponCodeGenerator/couponList.php?page=' . $nextPage . '"> 다음 </a>';
	}

	if($page != $allPage) { 												//마지막 페이지가 아니라면 끝 버튼을 생성
		$paging .= '<a href="../DLCouponCodeGenerator/couponList.php?page=' . $allPage . '"> 끝 </a>';
	}
	
	$paging .= '</a>';
  

	$currentLimit = ($onePage * $page) - $onePage; 							//몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; 				//limit sql 구문

	$sql = "SELECT * from comento.tbl_cpub order by cpub_no desc " . $sqlLimit; //원하는 개수만큼 선택
	$result_num = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html>
  	<head> 
    	<title>Coupon List Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  	</head>
    
  	<body> 
  		<table>
            <thead>
            	<tr>
					<th style="border-right: solid;">No</th>
					<th style="border-right: solid;">Group</th>
					<th style="border-right: solid;">Number in group</th>
					<th style="border-right: solid;">Coupon code</th>
					<th style="border-right: solid;">User name</th>
					<th style="border-right: solid;">Date</th>
            	</tr>
            </thead>

            <tbody> 	

	            <?php
					$sql="SELECT * from comento.tbl_cpub order by cpub_no desc";
					$result=mysqli_query($link, $sql);

					while($row=mysqli_fetch_assoc($result_num)) {
						$datetime=explode(' ', $row['cpub_usedDate']);
						$date=$datetime[0];
						$time=$datetime[1];
					
					if($date==Date('Y-m-d')) {
						$row['cpub_usedDate']=$time;
					}
					else {
						$row['cpub_usedDate']=$date;
					}
	            ?>

            	<tr align="center">	
					<td style="border-right: solid;"> <?php echo $row['cpub_no']; ?> </td>
					<td style="border-right: solid;"> <?php echo $row['cpub_groupName']; ?> </td>
					<td style="border-right: solid;"> <?php echo $row['cpub_numInGroup']; ?> </td>
					<td style="border-right: solid;"> <?php echo $row['cpub_couponCode']; ?> </td>
					<td style="border-right: solid;"> <?php echo $row['cpub_userName']; ?> </td>
					<td style="border-right: solid;"> <?php echo $row['cpub_usedDate']; ?> </td>  
            	</tr>

				<?php
					}
				?>  
            </tbody>
  
<!--페이징 처리-->
    		<div class="paginate"> 
       			<div class="paging">
          			<?php echo $paging; ?>
        		</div>  
    		</div>  

  		</table>
	</body>
</html>