<?php
session_start(); // 세션 시작

$name = $_POST['name'];  //이름
$email = $_POST['email'];  //이메일
$password = $_POST['password'];  //비밀번호
$id = $_POST['id'];  //아이디
$nickname = $_POST['nickname'];  //닉네임
$gender = $_POST['gender'];  //성별

// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB','3307');

if($gender == '남성') $gender = 'M';
else $gender = 'W';

//사용자 정보 추가       아이디, 비밀번호, 이름, 닉네임, 성별, 이메일 주소
$sql = "INSERT INTO user (id, password, name, nickname, gender, email) VALUES ('$id', '$password', '$name', '$nickname', '$gender', '$email')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['user'] = $id; // 사용자의 아이디를 세션 변수에 저장
    echo "<meta http-equiv='refresh' content='0;URL=menu.php'>";
} else {
    echo "<script>alert('다시 시도해 주세요');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=joinUs.html'>";
}

mysqli_close($conn);  // 데이터베이스 연결 종료
?>