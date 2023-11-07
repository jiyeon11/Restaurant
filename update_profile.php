<?php
session_start(); // 세션 시작

$nickname = $_POST['nickname'];
$gender = $_POST['gender'];
$email = $_POST['email'];

// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB', '3307');

// 세션에 저장된 사용자 아이디 가져오기
$id = $_SESSION['user'];

// 회원 정보 업데이트 쿼리 실행
$sql = "UPDATE user SET nickname='$nickname', gender='$gender', email='$email' WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('회원 정보가 수정되었습니다.');</script>";
} else {
    echo "<script>alert('회원 정보 수정에 실패했습니다.');</script>";
}
echo "<meta http-equiv='refresh' content='0;URL=myPage.php'>";
mysqli_close($conn);  // 데이터베이스 연결 종료
?>