<? 
	session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>회원가입</title>
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="css/member_form.css">
	
	<script src="../common/js/jquery-1.12.4.min.js"></script>
	<script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
	<script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
	
	<script>
	 $(document).ready(function() {
  
         //id 중복검사
         $("#id").keyup(function() {    // id입력 상자에 id값 입력시
            var id = $('#id').val(); //aaa

            $.ajax({
                type: "POST",
                url: "check_id.php", /*매개변수인 check_id.php파일을 post방식으로 넘기세요*/
                data: "id="+ id,  /*매개변수id도 같이 넘겨줌*/
                cache: false, 
                success: function(data) /*이 메소드가 완료되면 date라는 변수 안에 echo문이 들어감*/
                {
                     $("#loadtext").html(data); /*span안에 있는 태그를 사용할것이기 때문에 html 함수사용*/
                }
            });
        });

        //nick 중복검사		 
        $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
            var nick = $('#nick').val();

            $.ajax({
                type: "POST",
                url: "check_nick.php",
                data: "nick="+ nick,  
                cache: false, 
                success: function(data)
                {
                     $("#loadtext2").html(data);
                }
            });
        });		 

    });
	</script>
	<script>
  
   function check_input()
   {
      if (!document.member_form.id.value)
      {
          alert("아이디를 입력하세요");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }


      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit(); 
		   // insert.php 로 변수 전송
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp1.value = "010";
      document.member_form.hp2.value = "";
      document.member_form.hp3.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
	  
      document.member_form.id.focus();

      return;
   }
</script>
</head>
<body>
    <h1><a href="../index.html" class="logo2">서대문자연사박물관</a></h1>
    
    <article id="content">  
	  <h2 class="hidden">서대문자연사박물관 회원가입</h2>  
        <form name="member_form" method="post" action="insert.php" class="joinBox">
        <fieldset>
            <legend class="hidden">회원가입 폼</legend>
            <p class="info"><i class="fas fa-check"></i>모든 항목은 필수 입력 사항입니다.</p>
            <div class="idBox">
                <label for="id" class="hidden">아이디</label>
                 <!-- 로그인 안 된 상태 --> 
                <input type="text" id="id" name="id" title="아이디" placeholder="아이디를 입력하세요." maxlength="10" required>
                <span id="loadtext"></span> <!-- 실시간 메세지를 찍기 위해 -->

            </div>
            <div class="pwBox">
                <label for="pass" class="hidden">비밀번호</label>
                <input type="password" id="pass" name="pass" title="비밀번호" class="mb10 pwBg1" placeholder="비밀번호" required>
                <label for="pass_confirm" class="hidden">비밀번호 확인</label>
                <input type="password" id="pass_confirm" name="pass_confirm" title="비밀번호 재확인" class="pwBg2" placeholder="비밀번호 재확인" required>
            </div>
            <div class="nameBox">
                <label for="name" class="hidden">이름</label>
                <input type="text" id="name" name="name" title="이름" placeholder="이름">
            </div>
            <div class="nameBox nameBox1">
                <label for="nick" class="hidden">닉네임</label>
                <input type="text" id="nick" name="nick" title="닉네임" placeholder="닉네임">
                <span id="loadtext2"></span>
            </div>
            <div class="telBox">
                <label class="hidden" for="hp1">연락처 앞3자리</label>
                <select name="hp1" id="hp1" title="휴대폰 앞3자리를 선택하세요.">
                    <option>010</option>
                    <option>011</option>
                    <option>016</option>
                    <option>017</option>
                    <option>018</option>
                    <option>019</option>
                </select> ㅡ
                <label class="hidden" for="hp2">연락처 가운데3자리</label>
                <input type="text" id="hp2" name="hp2" title="연락처 가운데3자리를 입력하세요." maxlength="4" required> ㅡ
                <label class="hidden" for="hp3">연락처 마지막3자리</label>
                <input type="text" id="hp3" name="hp3" title="연락처 마지막3자리를 입력하세요." maxlength="4" required>
            </div>
            <div class="mailBox">
                <label class="hidden" for="email1">이메일</label>
                <input type="text" id="email1" title="이메일 앞자리" name="email1" required>@
                <label class="hidden" for="email2">이메일주소</label>
                <input type="text" name="email2" id="email2" title="이메일 뒷자리" required>
            </div>
            <div class="subMit">
                <input type="button" id="submitGo" title="회원가입 하기" value="가입 하기" onclick="check_input()">
                <!--<input type="reset" value="다시 작성" title="회원정보 다시 작성" onclick="reset_form()">-->
                <div class="gomain"><a href="../index.html">가입 취소</a></div>
            </div>    
            </fieldset>
        </form>
	  
    </article>

</body>
</html>


