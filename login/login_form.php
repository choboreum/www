<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>서대문자연사박물관-로그인</title>
<link rel="stylesheet" href="css/member.css">
<script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrap">
    <h1><a href="../index.html" class="logo">서대문자연사박물관</a></h1>
	<div id="col2">
        <form  name="member_form" method="post" action="login.php"> 
		<div id="title">
			<h2 class="hidden">로그인</h2>
			<p>가입 시 입력하신 아이디와 비밀번호로 로그인이 가능합니다</p>
		</div>
       
		<div id="login_form">
			 <div class="clear"></div>

			 <div id="login2">
				<div id="id_input_button">
					<fieldset>
                        <input type="text" name="id" class="login_input" placeholder="아이디">
                        <input type="password" name="pass" class="login_input" placeholder="비밀번호">
                        <input type="submit" value="로그인" class="signup">
                    </fieldset>
                    
					<ul>
                        <li><i class="fas fa-lock"></i>보안접속</li>
                        <li>
                            <span><a href="id_find.php">아이디 찾기</a></span>
                            <span><a href="pw_find.php">비밀번호 찾기</a></span>
					    </li>
					</ul>
				</div>
				<div class="clear"></div>

				<div id="login_line"></div>
				<div id="join_button"><p>아직도 회원이 아니신가요?</p><a href="../member/join.html" class="go_join">회원가입</a></div>
			 </div>			 
		</div> <!-- end of form_login -->

	    </form>
	</div> <!-- end of col2 -->

</div> <!-- end of wrap -->
</body>
</html>