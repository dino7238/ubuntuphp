<?php
	include "db.php";

	$uid = $_GET["userid"];

	$sql = mq("select * from member where id='".$uid."'");//mysql에 uid값을 넣겠다
	$member = $sql->fetch_array();//mysql에 저장된 값들을 가져온다
	if($member==0)//member변수에 저장된 값이 없다면 사용가능한 아이디입니다
	{
?><!--사용가능한 아이디 입니다라는 팝업이 출력-->
	<div style='font-family:"malgun gothic"';><?php echo $uid; ?>는 사용가능한 아이디입니다.</div>
<?php
}else{//member변수에 저장된 값이 있다면 사용가능한 아이디입니다
?><!--는 사용할 수 없는 아이디입니다라는 팝업이 출력-->
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $uid; ?>는 사용할 수 없는 아이디입니다.<div>
<?php
	}
?>
<button value="닫기" onclick="window.close()">닫기</button>
<script>
</script>
