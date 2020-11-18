<? 
	session_start(); 
     @extract($_POST);
     @extract($_GET);
     @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>서대문자연사박물관-새소식</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub5/common/css/sub5common.css">
    <link rel="stylesheet" href="css/greet.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
    <!--[if IE9]>  
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->   
</head>

<?
	include "../lib/dbconn.php";

	
  if (!$scale)
    $scale=10;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from greet where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from greet order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;
?>

<body>
<? include "../common/sub_head.html" ?>
<!-- 메인비주얼영역 -->   
        <div class="visual">
            <img src="../sub5/common/images/sub5_main.jpg" alt="">
            <h3>소식 / 홍보</h3>
            <p>Seodaemun Museum of Natural History</p>
        </div>
        
<!-- 서브네비영역 -->    
        <ul class="subnav">
            <li><a id="nav1" href="../greet/list.php" class="current">새소식</a></li>
            <li><a id="nav2" href="../sub5/sub5_2.html">소식지</a></li>
            <li><a id="nav3" href="../sub5/sub5_3.html">정보공개</a></li>
        </ul>
        
<!-- 본문콘텐츠영역 -->
<article id="content">
    <div class="title_area">
        <div class="line_map">
            <span>HOME</span>&gt;<span>소식 / 홍보</span>&gt;<strong>새소식</strong>
        </div>
        <h2>새소식</h2>
        <p>서대문자연사박물관의 새로운 소식을 만나보세요.</p>
    </div>

        <div class="content_area">
        <div id="col2">

		<form  name="board_form" method="post" action="list.php?mode=search"> 
		<div id="list_search">
			<div id="list_search1">TOTAL <?= $total_record ?> 건  |  <?= $page ?> 페이지</div>
			<fieldset id="sch">
                <legend class="hidden">게시물 검색</legend>
                <form name="fsearch" method="get">
                <input type="hidden" name="bo_table" value="CS">
                <input type="hidden" name="sca" value="">
                <input type="hidden" name="sop" value="and">
                <label for="sfl" class="sound_only hidden">검색대상</label>
                <select name="find">
                    <option value="subject">제목</option>
                    <option value="content">내용</option>
                    <option value='name'>이름</option>
                    <option value='nick'>별명</option>
                </select>
                <label for="stx" class="sound_only hidden">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="search" value="" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only hidden">검색</span></button>
                </form>
            </fieldset>
		</div>
		</form>
		
		<div class="clear"></div>

		<div id="list_top_title">
			<ul>
				<li id="list_title1">번호</li>
				<li id="list_title2">제목</li>
				<li id="list_title3">글쓴이</li>
				<li id="list_title4">등록일</li>
				<li id="list_title5">조회수</li>
			</ul>		
		</div>

		<div id="list_content">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];

      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  

	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

?>
			<div id="list_item">
				<div id="list_item1"><?= $number ?></div>
				<div id="list_item2"><a href="view.php?num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a></div>
				<div id="list_item3"><?= $item_nick ?></div>
				<div id="list_item4"><?= $item_date ?></div>
				<div id="list_item5"><?= $item_hit ?></div>
			</div>
<?
   	   $number--;
   }
?>
			<div id="page_button">
				<div id="page_num"> <i class="fas fa-chevron-left"></i> &nbsp;&nbsp;&nbsp;&nbsp; 
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
           if($mode=="search"){
             echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search'> $i </a>"; 
            }else{    
            
			  echo "<a href='list.php?page=$i&scale=$scale'> $i </a>";
           }
		}      
   }
?>			
			&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>
				</div>
				<select name="scale" onchange="location.href='list.php?scale='+this.value" class="show">
                    <option value=''>보기</option>
                    <option value='5'>5</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
                </select>
                    
                <div id="button">
                    <a href="list.php?page=<?=$page?>">목록</a>&nbsp;
					
		
<? 
	if($userid)
	{
?>
		<a href="write_form.php">글쓰기</a>
<?
	}
?>
                </div>
			</div> <!-- end of page_button -->
		
        </div> <!-- end of list content -->

		<div class="clear"></div>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->

            
        </article>
        
<? include "../common/sub_foot.html" ?>
    
</body>
</html>