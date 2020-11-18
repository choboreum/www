<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$ripple = "free_ripple";

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);       
	
    $item_kinds   = $row[kinds];
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];
	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$is_html      = $row[is_html];
    
    $sql = "select * from $ripple where parent=$item_num";
    $result2 = mysql_query($sql, $connect);
    $num_ripple = mysql_num_rows($result2);


	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) 
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}
	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
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
    <script>
        function check_input()
        {
            if (!document.ripple_form.ripple_content.value)
            {
                alert("내용을 입력하세요!");    
                document.ripple_form.ripple_content.focus();
                return;
            }
            document.ripple_form.submit();
        }

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
        <div id="view_comment"> &nbsp;</div>
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div>
            <div id="view_title1_1"></div>
            <div id="view_title2"><?= $item_kinds ?>문의 | <?= $item_nick ?> | <?= $item_date ?></div>	
		</div>

		<div id="view_content">
		<span><i class="far fa-comment-dots"></i>
<?
		if ($num_ripple) //리플개수가 있으면 
				echo " $num_ripple"; 
?>
		</span>
<?
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i];
			$img_name = "./data/".$img_name;
			$img_width = $image_width[$i];
			
			echo "<img src='$img_name' width='$img_width'>"."<br><br>";
		}
	}
?>
			<?= $item_content ?>
		</div>

		<div id="ripple">
<?
	    $sql = "select * from free_ripple where parent='$item_num'";
	    $ripple_result = mysql_query($sql);

		while ($row_ripple = mysql_fetch_array($ripple_result))
		{
			$ripple_num     = $row_ripple[num];
			$ripple_id      = $row_ripple[id];
			$ripple_nick    = $row_ripple[nick];
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
?>
			<div id="ripple_writer_title">
                <ul>
                    <li id="writer_title1"><?=$ripple_nick?></li>
                    <li id="writer_title2"><?=$ripple_date?></li>
                    <li id="writer_title3"> 
                      <? 
                            if($userid=="master" || $userid==$ripple_id) //관리자또는 userid가 ripple_id인 사람(=댓글을 단 사람)
                              echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
                      ?>
                    </li>
                </ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
<?
		}
?>			
			<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
			<div id="ripple_box">
                <div id="ripple_box1"><?=$userid?></div>
				<div id="ripple_box2">
				    <textarea rows="5" cols="65" name="ripple_content" placeholder="댓글을 남겨보세요" required></textarea>
				</div>
				<div id="ripple_box3">
                    <input type="submit" onclick="check_input()" title="등록" value="등록" >
                </div>
			</div>
			</form>
		</div> <!-- end of ripple -->

		<div id="view_button">
				<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;
<? 
	if($userid==$item_id || $userid=="master" || $userlevel==1 )
        
	{
?>
				<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>&nbsp;
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>&nbsp;
<?
	}
?>
<? 
	if($userid)
	{
?>
				<a href="write_form.php?table=<?=$table?>">글쓰기</a>
<?
	}
?>
		</div>
		<div class="clear"></div>
    </div>
</article>
<? include "../common/sub_foot.html" ?>
</body>
</html>