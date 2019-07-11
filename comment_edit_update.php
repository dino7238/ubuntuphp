<?php
	require_once('db.php');
	$bno = $_GET['b_no'];
	$coId = $_GET['coId'];
	$coContent = $_GET['coContent'];
  $coNo = $_GET['co_no'];

echo $_GET['bno'];
echo $_GET['co_no'];
echo $_GET['coContent'];
echo $coId;

$sql = 'update comment_free set co_content="' . $coContent . '" where co_no = ' . $coNo;
$result = $db->query($sql);

if($result) {
?>
<script>
  alert('댓글이 정상적으로 작성되었습니다.');
  location.replace("./view.php?bno=<?php echo $_GET['bno']?>");
</script>
<?php
}
?>
