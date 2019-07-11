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
}

	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {//$_GET['bno']존재할때
		$bNo = $_GET['bno'];//$bNo=$_GET['bno']다
	}

	if(isset($bNo)) {//$bNo 존재할때
    //select * from board_free where b_no=.$bNo;로 나타내도된다.
		$sql = 'select b_title, b_content, b_id from board_free where b_no = ' . $bNo; //$bNo=b_no에 해당하는 b_title, b_content, b_id값을 가져오겠다 ex $bNo=4, b_no=4$bNo인 값의  b_title, b_content, b_id을 가져온다
    //query=데이터베이스 관리 시스템(DBMS)에서 데이터를 꺼내거나 검색, 수정, 삭제 등의 조작을 하기 위한 명령어
		$result = $db->query($sql);//mysqli_query($con,$sql)로 표현 가능, $sql을 담겠다
		$row = $result->fetch_assoc();//fetch_assoc필드명 혹은 alias(일명 …라 불리는)를 참고하여 값을 가져옵니다.
	}
?>
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

<body>
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
		<h3>자유게시판 글쓰기</h3>
		<div id="boardWrite">
			<form action="./write_update.php" method="post"><!--글쓰기 완료시 write_update.php로 포스트방식으로 이동-->
				<?php
        //$bNo가 존재할때
				if(isset($bNo)) {
          //hidden을 사용한 이유는 현재 작성중인 게시글의 번호는 보여지지 않게 하도록 하기 위해서
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';//form을 submit할때 현재 작성중인 게시판의 번호를 mysql에 보내기 위해서
				}
				?>
				<table id="boardWrite">
					<caption class="readHide"></caption>
					<tbody>
						<tr><!--아이디에 해당하는 폼을 구성하는 코드-->
							<th scope="row"><label for="bID">아이디</label></th>
							<td class="id">
								<!--아이디에는 세션 아이디가 출력되도록 만든 코드-->
								<input type="hidden" name="bID" value="<?=$_SESSION['userid']?>"<?=$_SESSION['userid'] ?> id="bID">
								<?php echo $_SESSION['userid'] ?>
							</td>
						</tr>
						<tr>
              <!--제목에 해당하는 폼을 구성하는 코드-->
							<th scope="row"><label for="bTitle">제목</label></th>
              <!--제목을 입력하지 않으면 안되도록 required를 입력-->
              <!--a==b?a:b를 3항 연산자, 만약a==b가 true라면 a를, false라면 b를 출력하는 연산-->
              <!--"글쓰기" 라면 null이 출력될 것이고, "글수정"이라면 $row['b_title']가 출력.-->
							<td class="title"><input type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:null?>" required></td>
						</tr>
						<tr>
              <!--내용에 해당하는 폼을 구성하는 코드-->
              <!--"글쓰기" 라면 null이 출력될 것이고, "글수정"이라면 $row['b_content']가 출력.-->
							<th scope="row"><label for="bContent">내용</label></th>
							<td class="content"><textarea name="bContent" id="bContent"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">
						<?php echo isset($bNo)?'수정':'작성'//처음 입력하는것이라면 작성이 출력되고 이미 입력되어있다면 수정이 출력된다?>
					</button type="button">
					<!--<a href="./main.php" class="btnList btn">목록</a>-->
				</div>
			</form>
		</div>
	</article>
</body>
</html>
