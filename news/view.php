<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
//table=concert & num=2 & page=1
	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];  //첨부파일의 실제이름
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];


	$image_copied[0] = $row[file_copied_0];    //날싸시간으로 바뀐이름 => 실제로 서브에 저장되는 파일명
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}
	
	for ($i=0; $i<3; $i++) //첨부된 이미지 처리를 위한 반복문
	{
		if ($image_copied[$i]) //업로드한 파일이 존재하면 0 1 2
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
            //GetImageSize(서버에 업로드된 파일 경로 파일명) => 배열형태의 리턴값이 됨
            /*=> GetImageSize에서 사이즈 하나만 넘어가는것이 아니라
            파일의 너비와 높이값, 종류(jpg,png,mp4,zip,...) : 이렇게 3가지가 순서대로 넘어감*/
            
			$image_width[$i] = $imageinfo[0];  //파일너비:이미지가 안깨져야함
			$image_height[$i] = $imageinfo[1]; //파일높이
			$image_type[$i]  = $imageinfo[2];  //파일종류

        if ($image_width[$i] > 785) //첨부된 이미지의 최대 폭 너비
				$image_width[$i] = 785;
		}
		else //첨부된 이미지가 없으면 모두 null값
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
    <title>서대문자연사박물관-<?= $item_subject ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub5/common/css/sub5common.css">
    <link rel="stylesheet" href="../greet/css/greet.css">
    
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
        <div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?>  |  <?= $item_date ?> </div>	
		</div>

		<div id="view_content">
            <div id="hit_title"><i class="fas fa-eye"></i> <?= $item_hit ?></div>
<?
	for ($i=0; $i<3; $i++)  //업로드된 이미지를 출력한다
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i]; //2019_03_22_10_07_15_0.jpg
			$img_name = "./data/".$img_name; 
             // ./data/2019_03_22_10_07_15_0.jpg => 경로까지 더한 애가 최종으로 들어
			$img_width = $image_width[$i];
			
			echo "<img src='$img_name' width='$img_width' alt=''>"."<br><br>";
		}
	}
?>
			<?= $item_content ?>
		</div>

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

	</div> <!-- end of col2 -->

</div>
</article> 
<? include "../common/sub_foot.html" ?>   
</body>
</html>