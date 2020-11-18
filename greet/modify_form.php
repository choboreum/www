<? 
	session_start(); 
     @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
   //세션변수 4
    //num=7&page=1

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);       	
	$item_subject     = $row[subject];
	$item_content     = $row[content];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>서대문자연사박물관-수정</title>
    
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
		<div class="clear"></div>

		<div id="write_form_title">글수정</div>

		<div class="clear"></div>
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>"> 
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1">
				<div class="col1"> 닉네임 </div>
				<div class="col2"><?=$usernick?></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>" ></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
		</div>

		<div id="write_button"><input type="submit" id="wrbtn" title="제출">&nbsp;
            <a href="list.php?page=<?=$page?>">목록</a>
		</div>
		</form>

	</div> <!-- end of col2 -->
    </div>
    
</article>   
<? include "../common/sub_foot.html" ?> 
</body>
</html>