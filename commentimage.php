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
      <div id="co_<?php echo $row['co_no1']?>"  class="commentSet">

					<div class="commentInfo1">
						<div class="commentId1">작성자: <span class="coId1"><?php echo $row['co_id1']?></span></div>
						<div class="commentBtn1">
							<div class="commentContent1">내용:  <?php echo $row['co_content1']?></div>

							<a href="deletecomment.php?co_no=<?php echo $row['co_no1']?>&b_no=<?php echo $row['b_no']?>"><input type="submit" value="댓글 삭제"></a>
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
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent"></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="submit" value="코멘트 작성">

	</div>
</form>
