<?php
session_start();
$id = $_SESSION['user'];

$conn = mysqli_connect('localhost','root','111111','restaurantDB','3307');
$sql = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$re = mysqli_fetch_row($result);
mysqli_close($conn);  // 데이터베이스 연결 종료
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <style>
        /* 기본 스타일 */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .section {
            background-color: white;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
        }
        .section h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
            margin-right: 10px;
        }
        .form-group p {
            margin: 2px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 98%;
            padding: 10px;
            padding-right: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button, a.button {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        button:hover, a.button:hover {
            background-color: #45a049;
        }
        textarea{
            width: 98%;
            height: 100px;
            padding: 10px;
            resize: none;
            font-size: 18px;
        }
        /* 리뷰 스타일 */
        .review-item {
            display: inline-block;
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        .review-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 10px 10px;
        }
        .review-item h3 {
            font-size: 20px;
            margin-top: 10px;
        }
        .review-item p {
            font-size: 16px;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="section">
            <h1 style="text-align: center;">이랏샤이마세</h1>
            <h2>회원 정보 수정</h2>
            <form action="update_profile.php" method="post">
                <div class="form-group">
                    <p>닉네임</p>
                    <input type="text" id="nickname" name="nickname" value="<?php echo $re[1]?>">
                </div>
                <div class="form-group">
                    <p>성별</p>
                    <select id="gender" name="gender">
                        <option value="M"<?php echo ($re[3] == 'M') ? ' selected' : ''; ?>>남성</option>
                        <option value="W"<?php echo ($re[3] == 'W') ? ' selected' : ''; ?>>여성</option>
                    </select>
                </div>
                <div class="form-group">
                    <p>이메일</p>
                    <input type="email" id="email" name="email" value="<?php echo $re[5]?>">
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <button type="submit">수정</button>
                    <a href="withdraw.html" class="button" style="background-color: #ff6347">회원탈퇴</a>
                </div>
            </form>
        </div>
        <div class="section">
            <h2>예약</h2>
            <form action="reservation.php" method="post">
                <br>
                <div class="form-group">
                    <p>예약자</p>
                    <input type="text" name="name" value="<?php echo $re[2] ?>">
                </div>
                <br>
                <div class="form-group">
                    <p>시간선택</p>
                    <input type="date" name="date"> <!-- 날짜 -->
                    <input type="time" name="time"> <!-- 시간 -->
                </div>
                <br>
                <div class="form-group">
                    <p>인원</p>
                    <input type="number" name="peopleNum" min="1" max="10" value="1">
                </div>
                <br>
                <div class="form-group">
                    <p>요청사항</p>
                    <input type="text" name="request">
                </div>
                <br><br><br>
                <div style=" text-align: center;">
                    <button type="submit" style=" display: inline-block;">예약하기</button>
                </div>
            </form>
        </div>   
        <div class="section">
            <h2>예약 확인</h2>
            <!-- 예약 정보 표시 -->
            <table>
                <thead>
                    <tr>
                        <th>예약자</th>
                        <th>예약 날짜</th>
                        <th>예약 시간</th>
                        <th>인원</th>
                        <th>요청사항</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 데이터베이스 연결
                    $conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB','3307');

                    // 예약 정보 가져오기
                    $sql = "SELECT * FROM reservations WHERE name='$re[2]' AND DATE(reservation_date) >= DATE(NOW())";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['reservation_date'] . "</td>";
                            echo "<td>" . $row['reservation_time'] . "</td>";
                            echo "<td>" . $row['number_of_people'] . "</td>";
                            echo "<td>" . $row['special_requests'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>예약된 정보가 없습니다.</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>작성한 리뷰 목록</h2>
            <?php
            // 데이터베이스에서 리뷰 정보를 가져와 표시하는 부분
            $conn = mysqli_connect('localhost','root','111111','restaurantDB','3307');
            $review_sql = "SELECT * FROM reviews WHERE name ='$id'";
            $res = mysqli_query($conn, $review_sql);
            $num = mysqli_num_rows($res);
            for ($i = 0; $i<$num; $i++) {
                $row = mysqli_fetch_row($res);
                echo '<div class="review-item">';
                if ($row[5] !== null) {
                    echo '<img src="'.$row[5].'" alt="리뷰 이미지">';
                }
                echo '<h3>'.$row[1].'</h3>';
                echo '<p>'.$row[2].'</p>';
                echo '<p>서비스 평점: '.$row[8].' / 맛 평점: '.$row[7].'</p>';
                echo '<p>좋아요: '.$row[6].'</p>';
                echo '<p>'.$row[4].'</p>';
                echo '</div>';
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
