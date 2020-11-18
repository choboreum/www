<?
   session_start();
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);

   //$table=메인테이블명
   //$num=메인번호
   include "../lib/dbconn.php";

   $sql = "select * from $table where num = $num";
   $result = mysql_query($sql, $connect);

   $row = mysql_fetch_array($result);

   $copied_name[0] = $row[file_copied_0];
   $copied_name[1] = $row[file_copied_1];
   $copied_name[2] = $row[file_copied_2];

   for ($i=0; $i<3; $i++) //업로드된 파일 삭제
   {
		if ($copied_name[$i]) 
	   {
			$image_name = "./data/".$copied_name[$i];
			unlink($image_name); 
	   }
   }

   $sql = "delete from $table where num = $num"; //메인글(해당 num) 삭제
   mysql_query($sql, $connect);
 
   $sql = "delete from free_ripple where parent=$num"; //해당 메인글의 댓글들(메인num이 담긴 parent) 삭제
   mysql_query($sql, $connect);

   mysql_close();

   echo "
	   <script>
	    location.href = 'list.php?table=$table';
	   </script>
	";
?>

