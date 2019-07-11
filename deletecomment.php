<?php
	include "db.php";
  $bNo = $_GET['b_no'];

echo $_GET['b_no'];
  ?>

<?php

	//mysql에 저장된 b_no에 해당하는 값을 삭제한다
$sql = 'delete from comment_free where co_no = ' .$_GET['co_no'];
	$result = $db->query($sql);//sql을 result값에 담는다.


//쿼리($result)가 정상 실행 됐다면,
if($result) {
	$msg = '댓글이 삭제되었습니다.';
	$replaceURL = './view.php?bno='.$bNo;

} else {
	$msg = '댓글을 삭제하지 못했습니다.';
?>
	<script>
	//글을 정상적으로 삭제했을 경우에는 $msg(정상적으로 글이 삭제되었습니다)에 해당하는 메세지가 출력
	 alert("<?php echo $msg?>");
	 //이전 화면으로 돌아가게 설정
		history.back();
	</script>
<?php
	exit;
}
?>
<script>
//글을 정상적으로 삭제하지 못할경우에는 $msg(글을 삭제하지 못했습니다)에 해당하는 메세지가 출력
	alert("<?php echo $msg?>");
	//location.replace = 기존페이지를 새로운 페이지로 변경시킴
	location.replace("<?php echo $replaceURL?>");//$replaceURL로 이동시킨다
</script>
