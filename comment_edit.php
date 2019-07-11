<?php
  include "db.php";
  $coContent = $_GET['co_content'];
  $coId = $_GET['co_id'];
  $bno = $_GET['b_no'];
?>

<!DOCTYPE html>
<?php echo $_GET['b_no'] ?>
<?php echo $_GET['co_no'] ?>
<?php echo $coContent ?>
<?php echo $coId ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>댓 글 수 정 하 기</h1>
    <form action="comment_edit_update.php?co_no=<?php $_GET['co_no']?>" method="get">
      <input type="hidden" name="bno" value="<?php echo $bno?>">
      <input type="hidden" name="co_no" value="<?php echo $_GET['co_no']?>">
      <input type="hidden" name="co_id" value="<?php echo $coId ?>">
      <tr>
				<td><textarea name="coContent" id="coContent"><?php echo $coContent ?></textarea></td>
			</tr>
      <input type="submit" value="수정하기">
    </form>
  </body>
</html>
