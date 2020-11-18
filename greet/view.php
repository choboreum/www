<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    //세션변수
    //view.php?num=7&page=1
    //$num=1; (실제 레코드의 num)
    //$page=1; (페이지 번호)

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

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

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	$new_hit = $item_hit + 1;

	$sql = "update greet set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>서대문자연사박물관-<?= $item_subject ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub5/common/css/sub5common.css">
    <link rel="stylesheet" href="css/greet.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
    <!--[if IE9]>  
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  
    <script>
        function del(href) 
        {
            if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                    document.location.href = href;
            }
        }
    </script>
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
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?>  |  <?= $item_date ?> </div>	
		</div>

		<div id="view_content">
		    <div id="hit_title"><i class="fas fa-eye"></i> <?= $item_hit ?></div>
			<?= $item_content ?>
		</div>

		<div id="view_button">
            <a href="list.php?page=<?=$page?>">목록</a>&nbsp;
<? 
	if($userid==$item_id || $userlevel==1 || $userid=="admin")
    //로그인한 사람의 아이디==실제 레코드의 아이디 또는 레벨1==관리자 또는 유저아이디==Master (Master는 admin 혹은 관리자 등등 으로 교체 할 수 있음, 관리자를 칭함)
	{
?>
            <a href="modify_form.php?num=<?=$num?>&page=<?=$page?>">수정</a>&nbsp;
            <!--num값은 프라이머리키 이기 때문에 넘겨줘야 함-->
            <a href="javascript:del('delete.php?num=<?=$num?>')">삭제</a>&nbsp;
            <!--매개변수 : (처리할 delete.php?뷰 되어있는 레코드의 num) 을 넘김-->
<?
	}
?>
<? 
	if($userid )  //로그인이 되면 글쓰기
	{
?>
            <a href="write_form.php">글쓰기</a>
<?
	}
?>
		</div>

		<div class="clear"></div>

	</div> <!-- end of col2 -->
</div> <!-- end of content -->
</article>

<? include "../common/sub_foot.html" ?>

</body>
</html>
