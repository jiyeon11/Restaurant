<?php
// POST로 전달된 사용자 입력값 받기
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
    echo "<script>alert('회원가입 성공');</script>";
} else {
    echo "<script>alert('회원가입 실패');</script>";
}
mysqli_close($conn);  // 데이터베이스 연결 종료

?>