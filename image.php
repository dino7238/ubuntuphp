<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
	<div style="width: 300px; margin:0 auto;">
		<h3>이미지 파일 업로드 연습</h3>

		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div>
				<input type="file" name="fileToUpload" id="fileToUpload">
			</div>
			<input type="submit" value="업로드" name="submit" style="margin: .9em">
		</form>
	</div>

	<!-- database에서 이미지 목록을 가져 온다. -->
	<ul>
<?php
	include_once 'db.php';
	$conn = mysqli_connect("127.0.0.1","root","qudvlf","0811member");
	if(mysqli_connect_errno()){
		echo "연결실패! ".mysqli_connect_error();
	}
	$query = "SELECT * FROM images";
	$result = mysqli_query($conn, $query);

	while($data = mysqli_fetch_array($result)){

		echo '<li style=\'float:left; margin: 2px;\'>';
		echo '<img src='.$data['imgurl'].' width=200><br>';
		echo ($data['filename']);
		echo '</li>';
	}

   mysqli_close($conn);
?>

	</ul>


 </body>
</html>
