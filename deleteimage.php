<?php
include 'db_connect.php';

$bbsNo=$_GET['bbsNo'];

$sql='delete from test_bbs where bbsNo= ' . $bbsNo;
$result1 =$connect->query($sql);

$sql='delete from test_image where bbsNo= ' . $bbsNo;
$result2 =$connect->query($sql);

if($result1 && $result2){
  ?>
  <script>
  alert("글이 삭제되었습니다.");
  location.href="list.php";
  </script>
<?php }else{?>
  <script>
  alert("글이 삭제되지 않았습니다.");
  history.go(-1);
  </script>
<?php }?>
