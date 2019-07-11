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
}?>

<?php
include 'db_connect.php';
$sql="select * from test_bbs order by bbsNo desc";
$result=$connect->query($sql);
?>

<?php /* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$sql = 'select count(*) as cnt from test_bbs order by bbsNo desc';
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$allPost = $row['cnt']; //전체 게시글의 수
	$onePage = 5; // 한 페이지에 보여줄 게시글의 수.
	$allPage = ceil($allPost / $onePage); //전체 페이지의 수

	if($page < 1 || ($allPage && $page > $allPage)) {
?>

		<script>
			alert("존재하지 않는 페이지입니다.");
			history.back();
		</script>

<?php
		exit;
	}
	$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
	$currentSection = ceil($page / $oneSection); //현재 섹션
	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지
	if($currentSection == $allSection) {
		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
	} else {
		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
	}
	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
	$paging = '<ul>'; // 페이징을 저장할 변수
	//첫 페이지가 아니라면 처음 버튼을 생성
	if($page != 1) {
		$paging .= '<li class="page page_start"><a href="./list.php?page=1">처음</a></li>';
	}
	//첫 섹션이 아니라면 이전 버튼을 생성
	if($currentSection != 1) {
		$paging .= '<li class="page page_prev"><a href="./list.php?page=' . $prevPage . '">이전</a></li>';
	}
	for($i = $firstPage; $i <= $lastPage; $i++) {
		if($i == $page) {
			$paging .= '<li class="page current">' . $i . '</li>';
		} else {
			$paging .= '<li class="page"><a href="./list.php?page=' . $i . '">' . $i . '</a></li>';
		}
	}
	//마지막 섹션이 아니라면 다음 버튼을 생성
	if($currentSection != $allSection) {
		$paging .= '<li class="page page_next"><a href="./list.php?page=' . $nextPage . '">다음</a></li>';
	}
	//마지막 페이지가 아니라면 끝 버튼을 생성
	if($page != $allPage) {
		$paging .= '<li class="page page_end"><a href="./list.php?page=' . $allPage . '">끝</a></li>';
	}
	$paging .= '</ul>';
	/* 페이징 끝 */
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
	$sql = 'select * from test_bbs order by bbsNo desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
	$result = $db->query($sql); ?>

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
	<title>이미지게시판</title>
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
<center>

</div>
<h3>이미지게시판</h3>
<div id="boardList">
    <table>
      <thead>
        <tr>
          <th scope="col" class="no">번호</th>
          <th scope="col" class="title">제목</th>
          <th scope="col" class="author">작성자</th>
          <th scope="col" class="date">작성일</th>
        </tr>
      <?php
      while($data=$result->fetch_assoc()){?>
      <tr>
      <td class="no"><?=$data['bbsNo']?></td>
      <td class="title"><a style="color:black"  href="view11.php?bbsNo=<?=$data['bbsNo']?>">
      <?=$data['content']?></a></td>
    <td class="author"><?=$data['id']?></td>

    <td class="date"><?php echo $data['regdate']?></td>
</tr>
<?php
}
?>
</table>


    <!--글쓰기 버튼 코드-->
    <div class="btnSet">
      <a href="form.php"><input style="color:black" type="button" value="글쓰기"/></a>
    </div>
    <div class="paging">
    	<?php echo $paging ?>
    </div>
</body>
</html>
