<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);       
	
        $item_kinds   = $row[kinds];
		$item_subject = $row[subject];
		$item_content = $row[content];
		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>서대문자연사박물관-문의글쓰기</title>
    
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
          if (!document.board_form.subject.value)
          {
              alert("제목을 입력하세요1");    
              document.board_form.subject.focus();
              return;
          }
          if (!document.board_form.content.value)
          {
              alert("내용을 입력하세요!");    
              document.board_form.content.focus();
              return;
          }
          document.board_form.submit();
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
        <div id="write_form_title">문의글쓰기</div>
		<div class="clear"></div>
<?
	if($mode=="modify")
	{
?>
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data">
<?
	}
	else
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
?>
		<div id="write_form">
			<div id="write_row1">
			    <div class="col1">글쓴이</div>
			    <div class="col2"><?=$usernick?></div>	
			</div>
			
			<div id="write_row2_1">
                <div class="col1">문의유형</div>
                <div class="col2">
                    <select name="kinds" class="kinds">
                        <option value='기타' <? if($item_kinds == "선택") echo "selected='selected'"; ?>>선택</option>
                        <option value='이용관련' <? if($item_kinds == "이용관련") echo "selected='selected'"; ?>>이용관련</option>
                        <option value='회원관련' <? if($item_kinds == "회원관련") echo "selected='selected'"; ?>>회원관련</option>
                        <option value='자원봉사관련' <? if($item_kinds == "자원봉사관련") echo "selected='selected'"; ?>>자원봉사관련</option>
                        <option value='교육관련' <? if($item_kinds == "교육관련") echo "selected='selected'"; ?>>교육관련</option>
                    </select>
                </div>
            </div>
			
			<div id="write_row2">
                <div class="col1">제목</div>
                <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>" placeholder="문의합니다" required></div>
			</div>
			<div id="write_row3">
                <div class="col1">내용</div>
                <div class="col2">
                    <textarea rows="15" cols="79" name="content"><?=$item_content?></textarea>
                </div>
			</div>
			<div id="write_row4">
                <div class="col1">이미지파일1</div>
                <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
			<div class="clear"></div>
<? 	if ($mode=="modify" && $item_file_0)
	{
?>
			<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div id="write_row5">
                 <div class="col1"> 이미지파일2  </div>
                 <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $item_file_1)
	{
?>
			<div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div class="clear"></div>
			<div id="write_row6">
                 <div class="col1"> 이미지파일3   </div>
                 <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $item_file_2)
	{
?>
			<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div class="write_line"></div>
			<div class="clear"></div>
		</div>
        
		<div id="write_button">
            <a href="#" onclick="check_input()">제출</a>
            <a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
		</div>
		</form>

    </div>
</article>
<? include "../common/sub_foot.html" ?>
</body>
</html>