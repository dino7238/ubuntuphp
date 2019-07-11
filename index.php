<?php
SESSION_start();
include "db.php";
$URL="./index2.php";
//isset=변수가 설정되어있는지 확인할때 사용하는 코드(변수 존재 여부 확인)
//empty=확인할 변수명
//세션[id]가 설정되어있지 않는다면 로그인 화면으로 이동시키게 만들기
if(!isset($_SESSION['userid'])){//세션[id]가 설정되어 있지 않는 조건일때
  ?>
  <script>
  //alert은 팝업을 출력시키고("aa") 팝업안에 aa라는 문구가 출력된다
  alert("권한이 없습니다. 로그인 하세요.");
  //location.replace = 기존페이지를 새로운 페이지로 변경시킴
  location.replace("<?php echo $URL?>");//현재 페이지에서 $URL페이지로 이동시킨다.
  </script>
  <?php
}?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="chat.js"></script>
    <link rel="stylesheet" type="text/css" href="chat.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>전적검색사이트</title>
    <!-- Bootstrap core CSS -->
    <link href="startbootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="startbootstrap/css/one-page-wonder.min.css" rel="stylesheet">
	<link rel="stylesheet" href="normalize.css" />
	<link rel="stylesheet" href="board.css" />
</head>


<body>
  <center>

  <header class="masthead text-center text-black"><!--배경 색입히는 코드-->
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index3.php">byungpil's 전적검색 사이트</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="lol.php">전적검색</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="main.php">자유게시판</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list.php">이미지게시판</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">채팅하기</a>
            </li>
          </ul>
          <div style="color:gray" align="right">
            <?php
            if(isset($_SESSION['userid'])){
              echo $_SESSION['userid'];
              ?>님 안녕하세요!
            <br><div align="right"><a href="logout.php"><input type="button" value="로그아웃" /></div></a>
            <?php
          }
          ?>
        </div>
      </div>
      </div>
    </nav>
<dl id="list"></dl>
<form onsubmit="chatManager.write(this); return false;">
	<td class="id">
		<!--아이디에는 세션 아이디가 출력되도록 만든 코드-->
		<input type="hidden" name="name" value="<?=$_SESSION['userid']?>"<?=$_SESSION['userid'] ?> id="name">
		<?php echo $_SESSION['userid'] ?>
	</td>
	<input name="msg" id="msg" type="text" />
	<input name="btn" id="btn" type="submit" value="입력" />

</form>
</body>
</html>
