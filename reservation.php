<?php
$name = $_POST['name'];  //예약자
$date = $_POST['date'];  //날짜
$time = $_POST['time'];  //시간
$peopleNum = $_POST['peopleNum'];  // 인원
$request = $_POST['request'];  //요청사항
echo $date;
// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB','3307');
$sql = " insert into reservations (name,reservation_date,reservation_time,number_of_people,special_requests) values('$name','$date','$time',$peopleNum,$request)";
$result = mysqli_query($conn, $sql);
echo "<script>alert('예약 완료');</script>";
echo "<meta http-equiv='refresh' content='0;URL=myPage.php'>";
?>