<?php
session_start();
$id = $_SESSION['user'];

$password = $_POST["password"];

// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB', '3307');


$sql = "SELECT * FROM user WHERE id = '$id' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {  // 비밀번호가 일치하는 경우, 사용자 정보를 삭제
    $delete_sql = "DELETE FROM user WHERE id = '$id'";
    mysqli_query($conn, $delete_sql);
    echo "<script>alert('회원탈퇴가 완료되었습니다.');</script>";

    session_unset(); // 모든 세션 변수 제거
    session_destroy(); // 세션 종료

    echo "<meta http-equiv='refresh' content='0;URL=menu.php'>";
} else {  // 비밀번호가 불일치하는 경우
    echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=withdraw.html'>";
}

mysqli_close($conn); // 데이터베이스 연결 종료
?>