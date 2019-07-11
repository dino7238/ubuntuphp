<?php
//뷰 페이지에서 세션유지하기 위해서 세션 스타트를 한다.
SESSION_start();
include "db.php";
$URL="index2.php";
$id =$_SESSION['userid'];//변수 id는 로그인한 세션 아이디로 설정한다.
//로그인을 하지 않았을 때 메인 화면(로그인화면)으로 이동하게 만들기
if(!isset($_SESSION['userid'])){
  ?>
	<script>
  alert("로그인 후 볼 수 있습니다.");
  location.replace("<?php echo $URL?>");
  </script>
  <script>
  function editidcheck(){//editidcheck의 메소드를 생성
    alert("권한이 없습니다.");//권한이 없습니다라는 팝업이 출력되게 만듬
  	}
  </script>
  <?php
}?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
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
	<title>byungpil's 자유게시판</title>
	<link rel="stylesheet" href="normalize.css" />
	<link rel="stylesheet" href="board.css" />
</head>
<body>
  <header class="masthead text-center text-black"><!--배경 색입히는 코드-->
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>

  <center>
	<article class="boardArticle">
    <!-- Navigation -->
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
              <a class="nav-link" href="../main.php">자유게시판</a>
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
<?php

if(empty($_REQUEST["search_word"])){ // 검색어가 empty일 때 예외처리를 해준다.

$search_word ="";

}else{

$search_word =$_REQUEST["search_word"];

}

?>


<form class="navbar-form pull-left" method="get" action="https://www.op.gg/summoner/" target="_blank"> <!-- action 을 비워놔야 자신을 가리킨다 -->

  <input type="text" name="userName" class="form-control" placeholder="소환사의 아이디를 입력 후 enter를 누르세요" autofocus required>
  <button type="summit" class="btn btn-danger">검색</button>


<!--
<input type="text" name="userName" class="form-control" placeholder="소환사의 아이디를 입력 후 enter를 누르세요" autofocus>
<button type="submit" onclick="check();">검색</button>

<button type="summit" class="btn btn-danger">검색</button>
-->
</form>
