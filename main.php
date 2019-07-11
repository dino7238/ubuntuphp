<?php
SESSION_start();
include "db.php";
$URL="./index.php";
if(!isset($_SESSION['userid'])){
  ?>
  <script>
  alert("로그인 하세요");
  location.replace("<?php echo $URL?>");
  </script>
	<script>
	function check(){
	  alert("권한이 없습니다.");
		}
	</script>
  <?php
}

/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

/* 검색 시작 */
//'searchColumn' html에서 searchColumn의 id를 가진 값
if(isset($_GET['searchColumn'])) {//searchColumn이 존재할경우
	$searchColumn = $_GET['searchColumn'];//$searchColumn=$_GET['searchColumn']이다, searchColumn은 작성자,내용,제목 중 하나
	$subString .= '&amp;searchColumn=' . $searchColumn;//$subString=
}
if(isset($_GET['searchText'])) {
	$searchText = $_GET['searchText'];
	$subString .= '&amp;searchText=' . $searchText;
}
if(isset($searchColumn) && isset($searchText)) {
	$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
} else {
	$searchSql = '';
}
/* 검색 끝 */
$sql = 'select count(*) as cnt from board_free' . $searchSql;
$result = $db->query($sql);//sql을 result값에 담는다.
$row = $result->fetch_assoc();//해당되는 sql에 담겨져있는 값을 가져온다.
$allPost = $row['cnt']; //전체 게시글의 수
if(empty($allPost)) {//$allPost가 존재하지 않을때, 글이 존재하지 않는다는 문구를 출력시킨다
	$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
} else {
	$onePage = 5; // 한 페이지에 보여줄 게시글의 수.
  //ceil() 함수는 x보다 크거나 같은 가장 작은 정수를 계산합니다.
	$allPage = ceil($allPost / $onePage); //전체 페이지의 정수

	if($page < 1 && $page > $allPage) {
?>
		<script>
			alert("존재하지 않는 페이지입니다.");
			history.back();
		</script>
<?php
		exit;
	}
	$oneSection = 5; //한번에 보여줄 총 페이지 개수
	$currentSection = ceil($page / $oneSection); //현재 섹션(현재 보여지는 페이지의 갯수)
	$allSection = ceil($allPage / $oneSection); //전체 섹션(전체 페이지의 갯수)의 수
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
		//$paging .= '<li class="page page_start"><a href="main.php?page=1' . $subString . '">처음</a></li>';
	}
	//첫 섹션이 아니라면 이전 버튼을 생성
	if($currentSection != 1) {
		$paging .= '<li class="page page_prev"><a href="main.php?page=' . $prevPage . $subString . '">이전</a></li>';
	}
	for($i = $firstPage; $i <= $lastPage; $i++) {
		if($i == $page) {
			$paging .= '<li class="page current">' . $i . '</li>';
		} else {
			$paging .= '<li class="page"><a href="main.php?page=' . $i . $subString . '">' . $i . '</a></li>';
		}
	}
	//마지막 섹션이 아니라면 다음 버튼을 생성
	if($currentSection != $allSection) {
		$paging .= '<li class="page page_next"><a href="main.php?page=' . $nextPage . $subString . '">다음</a></li>';
	}
	//마지막 페이지가 아니라면 끝 버튼을 생성
	if($page != $allPage) {
		//$paging .= '<li class="page page_end"><a href="main.php?page=' . $allPage . $subString . '">끝</a></li>';
	}
	$paging .= '</ul>';
	/* 페이징 끝 */
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
	$sql = 'select * from board_free' . $searchSql . ' order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
	$result = $db->query($sql);
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

		<h3>자유게시판</h3>
		<div id="boardList">
				<table>
					<thead>
						<tr>
							<th scope="col" class="no">번호</th>
							<th scope="col" class="title">제목</th>
							<th scope="col" class="author">작성자</th>
							<th scope="col" class="date">작성일</th>
							<th scope="col" class="hit">조회</th>
						</tr>
					</thead>
					<tbody>
							<?php
							if(isset($emptyData)) {
								echo $emptyData;
							} else {
								while($row = $result->fetch_assoc())
								{
									$datetime = explode(' ', $row['b_date']);
									$date = $datetime[0];
									$time = $datetime[1];
									if($date == Date('Y-m-d'))
										$row['b_date'] = $time;
									else
										$row['b_date'] = $date;

                    $sql2 = mq("select * from comment_free where b_no='".$row['b_no']."'"); //reply테이블에서 con_num이 board의 idx와 같은 것을 선택(댓글개수)
                    $rep_count = mysqli_num_rows($sql2); //num_rows로 정수형태로 출력
							?>
							<tr>
								<td class="no"><?php echo $row['b_no']?></td>
								<td class="title" >
									<a style="color:black" href="./view.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a>
                  [<?php echo $rep_count; //댓글 갯수 ?>]
								</td>
								<td class="author"><?php echo $row['b_id']?></td>
								<td class="date"><?php echo $row['b_date']?></td>
								<td class="hit"><?php echo $row['b_hit']?></td>
							</tr>
							<?php
								}
							}
							?>
					</tbody>
				</table>
        <!--글쓰기 버튼 코드-->
				<div class="btnSet">
          <a href="./write.php"><input style="color:black" type="button" value="글쓰기"/></a>
				</div>
        <!--게시글 검색 코드-->
				<div class="paging">
					<?php echo $paging ?>
				</div>
				<div class="searchBox">
					<form action="main.php" method="get">
						<select name="searchColumn">
							<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
							<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
							<option <?php echo $searchColumn=='b_id'?'selected="selected"':null?> value="b_id">작성자</option>
						</select>
						<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>" required>
            <button type="submit" onclick="check();">검색</button>
					</form>
				</div>
			</div>
		</article>

	</body>
	</html>