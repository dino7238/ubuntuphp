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
<html lang="en">

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
<link rel="stylesheet" href="normalize.css" />
<link rel="stylesheet" href="board.css" />
</head>
<body>

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
            <a class="nav-link" href="#">이미지게시판</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">채팅하기</a>
          </li>
        </ul>
        <div style="color:gray" align="right">
            <?php
            if(isset($_SESSION['userid'])){
              echo $_SESSION['userid'];
              ?>님 안녕하세요!
            <br><div align="right"><a href="../logout.php"><input type="button" value="로그아웃" /></div></a>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </nav>

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">byungpil's</h1>
        <h2 class="masthead-subheading mb-0">전적검색 사이트</h2>
        <a href="lol.php" class="btn btn-primary btn-xl rounded-pill mt-5">리그오브레전드 전적검색</a>
        <!--<a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">배틀그라운드</a>-->
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="startbootstrap/img/lol.jpeg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">롤 전적검색</h2>
            <p>유저들의 아이디를 입력하여 전적을 검색 할 수 있습니다.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="startbootstrap/img/freeboard.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">각종 게시판</h2>
            <p>게시판을 활용하여 유저들끼리 소통 할 수 있습니다.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="startbootstrap/img/chattitle.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">채팅하기</h2>
            <p>채팅을 통해서 유저간 대화를 할 수 있습니다.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
