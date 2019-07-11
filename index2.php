<?php
include "db.php"; ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>byungpil's php</title>
	<!-- 헤더부분에 삽입 -->
<script language="Javascript" type="text/javascript">
<!--
 function setCookie( name, value, expirehours ) {
  var todayDate = new Date();
  todayDate.setHours( todayDate.getHours() + expirehours );
  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
 }
 function closeWin() {
  if(document.getElementById("pop_today").checked){
   setCookie( "ncookie", "done" , 24 );
  }
  document.getElementById('layer_pop').style.display = "none";
 }
-->
</script>
<!-- 헤더부분에 삽입 -->


<style>
@import url(http://weloveiconfonts.com/api/?family=fontawesome);
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

* {
  box-sizing: border-box;
}

html {
  height: 100%;
}

body {
  background-color: #2c3338;
  color: #606468;
  font: 400 0.875rem/1.5 "Open Sans", sans-serif;
  margin: 0;
  min-height: 100%;
}

a {
  color: #eee;
  outline: 0;
  text-decoration: none;
}
a:focus, a:hover {
  text-decoration: underline;
}

input {
  border: 0;
  color: inherit;
  font: inherit;
  margin: 0;
  outline: 0;
  padding: 0;
  -webkit-transition: background-color .3s;
          transition: background-color .3s;
}

.site__container {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
      -ms-flex: 1;
          flex: 1;
  padding: 3rem 0;
}

.form input[type="password"], .form input[type="text"], .form input[type="submit"] {
  width: 100%;
}
.form--login {
  color: #606468;
}
.form--login label,
.form--login input[type="text"],
.form--login input[type="password"],
.form--login input[type="submit"] {
  border-radius: 0.25rem;
  padding: 1rem;
}
.form--login label {
  background-color: #363b41;
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  padding-left: 1.25rem;
  padding-right: 1.25rem;
}
.form--login input[type="text"], .form--login input[type="password"] {
  background-color: #3b4148;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}
.form--login input[type="text"]:focus, .form--login input[type="text"]:hover, .form--login input[type="password"]:focus, .form--login input[type="password"]:hover {
  background-color: #434A52;
}
.form--login input[type="submit"] {
  background-color: #ea4c88;
  color: #eee;
  font-weight: bold;
  text-transform: uppercase;
}
.form--login input[type="submit"]:focus, .form--login input[type="submit"]:hover {
  background-color: #d44179;
}
.form__field {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  margin-bottom: 1rem;
}
.form__input {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
      -ms-flex: 1;
          flex: 1;
}

.align {
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
}

.hidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.text--center {
  text-align: center;
}

.grid__container {
  margin: 0 auto;
  max-width: 20rem;
  width: 90%;
}

</style>
</head>

<body class="align">

  <div class="site__container">

    <div class="grid__container">

      <form action="login_ok.php" method="post" class="form form--login">

        <div class="form__field">
          <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
          <input name="userid" id="login__username" type="text" class="form__input" placeholder="아이디" required>
        </div>

        <div class="form__field">
          <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
          <input name="userpw" id="login__password" type="password" class="form__input" placeholder="비밀번호" required>
        </div>

        <div class="form__field">
          <input type="submit" value="로그인">
        </div>

      </form>

      <p class="text--center">아이디가 없다면 회원가입하세요. <a href="member.php">회원가입</a> <span class="fontawesome-arrow-right"></span></p>

    </div>

  </div>
	<!-- popup 영역 -->
	<div class="layer_popup" style="position:absolute; width:500px;left:50%; margin-left:-700px; top:90px; z-index:1;" id="layer_pop">
	<table width="500" border="0" cellpadding="0" cellspacing="0">
	<tr>
	 <td><img src="images/popupimage.jpg" width="500" height="500" border="0" /></td>
	</tr>
	<tr>
	 <td align="center" height="30" bgcolor="#333333">
	 <table width="95%" border="0" cellpadding="0" cellspacing="0">
	 <tr>
	  <td align="left" class="pop"><input type="checkbox" name="pop_today" id="pop_today" />오늘 하루 이 창 열지 않음</td>
	  <td align="right" class="pop"><a href="javascript:closeWin();">닫기</a></td>
	 </tr>
	 </table></td>
	</tr>
	</table>
	<script language="Javascript" type="text/javascript">
	<!--
	 cookiedata = document.cookie;
	 if (cookiedata.indexOf("ncookie=done") < 0){
	  document.getElementById('layer_pop').style.display = "inline";
	 } else {
	  document.getElementById('layer_pop').style.display = "none";
	 }
	-->
	</script>
	</div>
	<!-- popup 영역 -->

</body>
</html>
