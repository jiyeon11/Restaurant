<?php
$id = $_POST['id'];  //아이디
$password = $_POST['password'];  //비밀번호

// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB','3307');

$sql = "SELECT * FROM user WHERE id = '$id' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    echo "<script>alert('로그인 성공');</script>";
} else {
    echo "<script>alert('로그인 실패');</script>";
}

mysqli_close($conn);  // 데이터베이스 연결 종료
?>