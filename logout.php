<?php
	include "db.php";
  session_start();
	session_destroy();
?>
<meta charset="utf-8">
<script>alert("로그아웃되었습니다."); location.href="index2.php"; </script>
