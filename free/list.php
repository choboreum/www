<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$table = "free";
	$ripple = "free_ripple";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>서대문자연사박물관-묻고 답하기</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="css/free.css">
    <link rel="stylesheet" href="../sub6/common/css/sub6common.css">

    
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
		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
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
    <img src="../sub6/common/images/sub6_main.jpg" alt="">
    <h3>커뮤니티</h3>
    <p>Seodaemun Museum of Natural History</p>
</div>
        
<!-- 서브네비영역 -->    
<ul class="subnav">
    <li><a id="nav1" href="../sub6/sub6_1.html">자주 묻는 질문</a></li>
    <li><a id="nav2" href="list.php" class="current">묻고 답하기</a></li>
    <li><a id="nav3" href="../sub6/sub6_3.html">자원봉사</a></li>
    <li><a id="nav4" href="../sub6/sub6_4.html">표본기증</a></li>
</ul>

<!-- 본문콘텐츠영역 -->
<article id="content">
    <div class="title_area">
        <div class="line_map">
            <span>HOME</span>&gt;<span>커뮤니티</span>&gt;<strong>묻고 답하기</strong>
        </div>
        <h2>묻고 답하기</h2>
        <p>묻고답하기는 고객님의 소중한 의견을 듣는 곳입니다.<br>광고성 게시물, 욕설, 저속한 표현의 글은 삭제될 수 있으니 참고하시기 바랍니다.</p>
    </div>

    <div class="content_area">
     <form  name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search"> 
		<div id="list_search">
			<div id="list_search1">TOTAL <?= $total_record ?>  &nbsp;&nbsp;|&nbsp;&nbsp; PAGE <?= $page ?></div>
			<div id="sch">
                <label for="sfl" class="sound_only hidden">검색대상</label>
                <select name="find" id="sfl">
                    <option value="subject">제목</option>
                    <option value="kinds">문의유형</option>
                    <option value="content">내용</option>
                    <option value='nick'>글쓴이</option>
                </select>
                <label for="stx" class="sound_only hidden">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="search" value="" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <span class="sound_only hidden">검색</span>
                </button>
            </div>
		</div>
    </form>
    <div class="clear"></div>

   <div id="list_top_title">
			<ul>
				<li id="list_title1">답변여부</li>
				<li id="list_title2_1">문의유형</li>
				<li id="list_title2">제목</li>
				<li id="list_title3">글쓴이</li>
				<li id="list_title4">문의날짜</li>
			</ul>		
		</div>
   
    <div id="list_content">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);     // 포인터 이동        
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기	      

      $item_kinds   = $row[kinds];
	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];
      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	  $sql = "select * from $ripple where parent=$item_num";
	  $result2 = mysql_query($sql, $connect);
	  $num_ripple = mysql_num_rows($result2); //없으면 0, 있으면 해당개수 만큼

?>
        <div class="list_item">
           <a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>">
           <div class="list_item1">
<?
            if ($num_ripple) //리플개수가 있으면 
                    echo "<span>답변완료</span>"; 
            else
                    echo "접수"
?>
            </div>
            <div class="list_item2_1"><?= $item_kinds ?></div>
            <div class="list_item2"><?= $item_subject ?>
<?
		if ($num_ripple) //리플개수가 있으면 
				echo " [$num_ripple]"; 
?>
            </div>
            <div class="list_item3"><?= $item_nick ?></div>
            <div class="list_item4"><?= $item_date ?></div>
            </a>
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
			echo "<a href='list.php?table=$table&page=$i&scale=$scale'> $i </a>";
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
					<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;
<? 
	if($userid)
	{
?>
		<a href="write_form.php?table=<?=$table?>">글쓰기</a>
<?
	}
?>
				</div>
			</div> <!-- end of page_button -->		
        </div> <!-- end of list content -->
		<div class="clear"></div>
    </div>     


</article>                

<? include "../common/sub_foot.html" ?>
</body>
</html>