<?php
	$sql = 'select * from comment_free where co_no=co_order and b_no=' . $bno;
	$sql3 = 'select * from comment_free where b_no';
	$result = $db->query($sql);
	$result1 = $db->query($sql3);
	$row3 = $result1->fetch_assoc();
?>
<div id="commentView">
	<?php
		while($row = $result->fetch_assoc()) {
	?>
	<ul class="oneDepth">
		<li>
      <div id="co_<?php echo $row['co_no']?>"  class="commentSet">
					<div class="commentInfo">
						<div class="commentId">작성자: <span class="coId"><?php echo $row['co_id']?></span></div>
						<div class="commentBtn">
							<div class="commentContent">내용:  <?php echo $row['co_content']?></div>
							<!DOCTYPE HTML>
							<html>
							<head>
							    <meta charset="UTF-8">
							    <title></title>
							    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
							    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
							    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
							    <script>
							        //$(document.ready(function(){ .. });
							        $(function(){
							            //$("#dialog").dialog();
							            $("#dialog").dialog({
							                autoOpen:false, //자동으로 열리지않게
							                position:[100,200], //x,y  값을 지정
							                //"center", "left", "right", "top", "bottom"
							                modal:true, //모달대화상자
							                resizable:false, //크기 조절 못하게
							            });
							            //창 열기 버튼을 클릭했을경우
							            $("#btn").on("click",function(){
							                $("#dialog").dialog("open"); //다이얼로그창 오픈
							            });
							        });
							    </script>
							</head>
							<body>
							<input type="button" id="btn" value="수정하기"/>
							<div id="dialog" title="댓글 수정">
								<form action="comment_edit_update.php?co_no=<?php $row['co_no']?>" method="get">
									<input type="hidden" name="bno" value="<?php echo $row['b_no']?>">
									<input type="hidden" name="co_no" value="<?php echo $row['co_no']?>">
									<input type="hidden" name="co_id" value="<?php echo $coId ?>">
									<tr>
										<td><textarea name="coContent" id="coContent"><?php echo $row['co_content'] ?></textarea></td>
									</tr>
									<input type="submit" value="수정하기">
								</form>
							</div>
							</body>
							</html>
							<!--<a href="comment_edit.php?co_no=<?php echo $row['co_no']?>&b_no=<?php echo $row['b_no']?>&co_content=<?php echo $row['co_content']?>&co_id=<?php echo $_SESSION['userid']?>"><input type="submit" value="댓글 수정"></a>
							<a href="#" class="comt modify">댓글수정</a>-->
							<a href="deletecomment.php?co_no=<?php echo $row['co_no']?>&b_no=<?php echo $row['b_no']?>"><input type="submit" value="삭제하기"></a>
						</div>
					</div>
				</div>

			<?php
				$sql2 = 'select * from comment_free where co_no!=co_order and co_order=' . $row['co_no'];
				$result2 = $db->query($sql2);

				while($row2 = $result2->fetch_assoc()) {
			?>
			<?php
				}
			?>
		</li>
	</ul>
	<?php } ?>
</div>
<form action="comment_update.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bno?>">
	<table>
		<tbody>
			<tr>
        	<th scope="row"><label for="coId">아이디  :
        <td class="id">
          <!--아이디에는 세션 아이디가 출력되도록 만든 코드-->
          <input type="hidden" name="coId" value="<?=$_SESSION['userid']?>"<?=$_SESSION['userid'] ?> id="coId">
          <?php  echo $_SESSION['userid'] ?>
        </td>
        </label></th>
			</tr>
			<tr>
				<th scope="row"><label for="coContent" autofocus>내용</label></th>
				<td><textarea name="coContent" id="coContent" ></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="submit" value="코멘트 작성">

	</div>
</form>
