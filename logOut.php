<?php 
session_start(); // 세션 시작

session_unset(); // 모든 세션 변수 제거
session_destroy(); // 세션 종료

echo "<meta http-equiv='refresh' content='0;URL=menu.php'>";
?>