<?php
//뷰 페이지에서 세션유지하기 위해서 세션 스타트를 한다.
SESSION_start();
include "db.php";
$URL="./index2.php";
$id =$_SESSION['userid'];//변수 id는 로그인한 세션 아이디로 설정한다.
//로그인을 하지 않았을 때 메인 화면(로그인화면)으로 이동하게 만들기
if(!isset($_SESSION['userid'])){
  ?>
	<script>
  alert("로그인 후 볼 수 있습니다.");
  location.replace("<?php echo $URL?>");
  </script>
  <?php
}
	$bno = $_GET['bno'];//변수 bno는 'bno'로 나타낸다/
  //조회수 코드
  //$sql = 'update board_free set b_hit = b_hit + 1 where b_no = ' . $bno;//bno에 해당하는 게시판의 조회수가 1씩 늘어난다.
  //$result = $db->query($sql);//mysqli_query($con,$sql)로 표현 가능, sql을 담겠다라는 뜻
  if(!empty($bno) && empty($_COOKIE['board_free_' . $bno])) {
		$sql = 'update board_free set b_hit = b_hit + 1 where b_no = ' . $bno;
		$result = $db->query($sql);
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php
		} else {
			setcookie('board_free_' . $bno, TRUE, time() + (60 * 60 * 24), '/');
		}
	}

	$sql = 'select b_title, b_content, b_date, b_hit, b_id from board_free where b_no = ' . $bno;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?><?php
  //조회수 코드 끝
	$sql = 'select b_title, b_content, b_date, b_hit, b_id from board_free where b_no = ' . $bno;//$bno(b_no)에 해당하는 b_title, b_content, b_date, b_hit, b_id값을 가져온다.
	$result = $db->query($sql);//sql을 result값에 담는다.
	$row = $result->fetch_assoc();//해당되는 sql에 담겨져있는 값을 가져온다.
?>

</script>
<script>
function editidcheck(){//editidcheck의 메소드를 생성
  alert("권한이 없습니다.");//권한이 없습니다라는 팝업이 출력되게 만듬
	}
</script>
<script>
function edit(){//edit라는 메소드를 생성
	location.replace("./write.php?bno="<?php echo $bno?>);//글쓰
	}
</script>
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
  <link rel="stylesheet"
      href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="style.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
		<h3>자유게시판 글 읽기</h3>
		<div id="boardView">
			<h3 id="boardTitle">제목: <?php echo $row['b_title']//제목에 mysql에 b_title값을 가져온다.?></h3>
			<div id="boardInfo">
        <span id="boardID">작성자: <?php echo $row['b_id']//작성자에 mysql에 b_id값을 가져온다.?></span>
				<span id="boardDate">작성일: <?php echo $row['b_date']//작성일에 mysql에 b_date값을 가져온다.?></span>
				<span id="boardHit">조회: <?php echo $row['b_hit']//조회에 mysql에 b_hit값을 가져온다.?></span>
			</div>
			<fieldset>
			<div id="boardContent"><?php echo $row['b_content']//내용에 mysql에 b_content값을 가져온다.?></div>
		</fieldset>
			<div class="btnSet">
				<?php if($id==$row['b_id']){//작성자(아이디)와 세션 아이디가 같을 경우에는 수정 버튼을 누르면 수정 할 수 있도록 페이지를 이동한다.?>
					<a href=./write.php?bno=<?php echo $bno?>><input type="submit" value="수정" /></a>
		<?php } else {//작성자(아이디)와 세션 아이디가 같지 않을 경우에는 수정 버튼을 누르면 editidcheck() 메소드가 출력된다.?>
			<input type="button" value="수정" onclick="editidcheck();" />
		<?php } ?>
		<?php if($id==$row['b_id']){////작성자(아이디)와 세션 아이디가 같을 경우에는 삭제 버튼을 누르면 수정 할 수 있도록 페이지를 이동한다.?>
	<a href="delete_update.php?bno=<?php echo $bno?>"><input type="submit" value="삭제"</a>
<?php } else {//작성자(아이디)와 세션 아이디가 같지 않을 경우에는 삭제 버튼을 누르면 editidcheck() 메소드가 출력된다.?>
				<input type="button" value="삭제" onclick="editidcheck();" />
      <?php } //목록을 누르면 main.php로 이동하게 만듬??>
				<a href="./main.php"><input type="button" value="목록"/></a>
			</form>
			</div>
      <div id="boardComment">
			<?php require_once('comment.php')?>
		</div>
		</div>
	</article>
</body>
</html>
