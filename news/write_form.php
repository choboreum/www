<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
    //새글쓰기 =>  $table='concert'
    //수정 => $table=concert $mode=modify $num=1 $page=1

	include "../lib/dbconn.php";

	if ($mode=="modify") //수정 글쓰기면
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

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
    <title>서대문자연사박물관-글쓰기</title>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub5/common/css/sub5common.css">
    <link rel="stylesheet" href="../greet/css/greet.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
    <script>
      function check_input()
       {
          if (!document.board_form.subject.value)
          {
              alert("제목을 입력하세요!");    
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
        <li><a id="nav1" href="../news/list.php" class="current">새소식</a></li>
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
		<div id="write_form_title">글쓰기</div>
		<div class="clear"></div>

<?
	if($mode=="modify") //수정모드
	{

?>
        <form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> <!-- enctype : 이거 써줘야 이미지가 넘어감/ 넘겨주는 데이터가 크기 때문에 넘겨줄 수 있도록 도와줌 -->
<?
	}
	else //새글쓰기 모드
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
?>
		<div id="write_form">

			<div id="write_row1"><div class="col1"> 별명 </div><div class="col2"><?=$usernick?></div>
					
			</div>

			<div id="write_row2"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div> <!--값이 담겨져 있는건 수정일때에만-->
			</div>

			<div id="write_row3"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>

			<div id="write_row4"><div class="col1"> 이미지파일1   </div>
                 <div class="col2"><input type="file" name="upfile[]"></div><!--upfile[] : 배열로 넘어가는것-->
			</div>
			<div class="clear"></div>
<? 	if ($mode=="modify" && $item_file_0) //수정모드이면서 실제파일이 존재하면
	{
?>
			<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>

			<div id="write_row5"><div class="col1"> 이미지파일2  </div>
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
			<div id="write_row6"><div class="col1"> 이미지파일3   </div>
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
        
	</div> <!-- end of col2 -->
</div>
</article>
<? include "../common/sub_foot.html" ?>   
</body>
</html>