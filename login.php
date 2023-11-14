<?php
session_start(); // 세션 시작

$id = $_POST['id'];  //아이디
$password = $_POST['password'];  //비밀번호

// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB','3307');

$sql = "SELECT * FROM user WHERE id = '$id' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = $id; // 사용자의 아이디를 세션 변수에 저장
    echo "<meta http-equiv='refresh' content='0;URL=menu.php'>";
} else {
    echo "<script>alert('다시 시도해 주세요');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.html'>";
}
mysqli_close($conn);  // 데이터베이스 연결 종료
?>