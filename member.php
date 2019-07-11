<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>회원가입</title>
<script>
function checkid(){//checkid()메소드를 생성
	var userid = document.getElementById("uid").value;//userid=html의 "uid"이다
	if(userid)
	{
		url = "check.php?userid="+userid;
			window.open(url,"chkid","width=300,height=100");
		}else{
			alert("아이디를 입력하세요");
		}
	}
</script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(function(){
$('#pw').keyup(function(){
 $('font[name=check]').text('');
}); //#user_pass.keyup
$('#checkpw').keyup(function(){
 if($('#pw').val()!=$('#checkpw').val()){
  $('font[name=check]').text('');
  $('font[name=check]').html("비밀번호가 일치하지 않습니다.");
 }else{
  $('font[name=check]').text('');
  $('font[name=check]').html("비밀번호가 일치합니다.");include "db.php";
 }
}); //#chpass.keyup
});
</script>
<script>
function SetEmailTail(emailValue) {
  var email = document.all("email")    // 사용자 입력
  var emailTail = document.all("email2") // Select box

  if ( emailValue == "notSelected" )
   return;
  else if ( emailValue == "etc" ) {
   emailTail.readOnly = false;
   emailTail.value = "";
   emailTail.focus();
  } else {
   emailTail.readOnly = true;
   emailTail.value = emailValue;
  }
 }
</script>
</head>
<body>
   <center>
	<form method="post" action="member_ok.php" name="memform">
		<h1>회원가입</h1>
			<fieldset>
					<table>
						<tr>
							<td align=center>아이디</td>
							<td><input type="text" size="35" name="userid" id="uid" placeholder="아이디" required>
								<input type="button" value="중복검사" onclick="checkid();" />
							</td>
						</tr>
						<tr>
							<td align=center>비밀번호</td>
							<td><input type="password" size="35" name="userpw" id="pw" placeholder="비밀번호" required></td>
						</tr>
            <tr>
							<td align=center>비밀번호 확인</td>
							<td><input type="password" size="35" name="pwcheck" id="checkpw" placeholder="비밀번호 확인" required><font name="check" size="2" color="red"></font>
              </td>

						</tr>
						<tr>
							<td align=center>이름</td>
							<td><input type="text" size="35" name="name" placeholder="이름" required></td>
						</tr>
						<tr>
							<td align=center>주소</td>
							<td><input type="text" size="35" name="adress" placeholder="주소" required></td>
						</tr>
						<tr>
							<td align=center>성별</td>
							<td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
						</tr>
						<tr>
							<td align=center>이메일</td>
							<td><input type="text" name="email" id="email" required>@<input type="text" name="email2" value="" ReadOnly="true"/>
<select name="emailCheck"
onchange="SetEmailTail(emailCheck.options[this.selectedIndex].value)">
    <option value="notSelected" >::선택하세요::</option>
    <option value="etc">직접입력</option>
    <option value="naver.com">naver.com</option>
    <option value="nate.com">nate.com</option>
    <option value="msn.com">msn.com</option>
    <option value="hanmail.net">hanmail.net</option>
    <option value="yahoo.com">yahoo.com</option>
    <option value="gmail.com">gmail.com</option>
   </select>
</td>
						</tr>
					</table>
				<input type="submit" value="가입하기" /><input type="reset" value="다시쓰기" />
		</fieldset>
	</form>
</body>
</html>
