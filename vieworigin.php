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
  $sql = 'update board_free set b_hit = b_hit + 1 where b_no = ' . $bno;//bno에 해당하는 게시판의 조회수가 1씩 늘어난다.
  $result = $db->query($sql);//mysqli_query($con,$sql)로 표현 가능, sql을 담겠다라는 뜻
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
	<meta charset="utf-8" />
	<title>게시판</title>
	<link rel="stylesheet" href="normalize.css" />
	<link rel="stylesheet" href="board.css" />
</head>
<body>
	<center>
		<div align="right"><!--오른쪽에 나타내기 위한 코드-->
	<?php
  //세션아이디가 존재할 경우 세션 아이디가 출력되도록 만듬
	if(isset($_SESSION['userid'])){
		echo $_SESSION['userid'];
    ?>님 안녕하세요!
    <!--로그아웃 버튼을 만들고 로그아웃을 누를 경우 logout.php로 이동하게 만듬-->
	<br><a href="logout.php"><input type="button" value="로그아웃" /></a>
  <?php
}
?></div>
  <!--article class요소는 문서, 페이지, 어플리케이션 또는 사이트 안에 독립적으로 구분되거나 재사용 가능한 영역
  ex)글, 매거진/신문의 기사, 블로그 글-->
	<article class="boardArticle">
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
				<a href="./main.php"><input type="button" value="목록"</a>

			</form>
			</div>
		</div>
	</article>
</body>
</html>
