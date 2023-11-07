<?php
session_start(); // 세션 시작
$id = $_SESSION['user'];

$conn = mysqli_connect('localhost','root','111111','restaurantDB','3307');
$sql = "select * from user where id='$id'";
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
        .form-group p{
            margin: 2px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
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
                        <option value="M"<?php echo ($re[3] == 'M') ? 'selected' : ''; ?>>남성</option>
                        <option value="W"<?php echo ($re[3] == 'W') ? 'selected' : ''; ?>>여성</option>
                    </select>
                </div>
                <div class="form-group">
                    <p>이메일</p>
                    <input type="email" id="email" name="email" value="<?php echo $re[5]?>">
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <button type="submit">수정 완료</button>
                    <a href="withdraw.php" style="margin-right: 10px; margin-top: 15px">회원탈퇴</a>
                </div>
            </form>
        </div>

        <div class="section">
            <h2>예약 확인</h2>
            <!-- 예약 정보 표시 -->
        </div>

        <div class="section">
            <h2>작성한 리뷰 목록</h2>
            <!-- 리뷰 목록 표시 -->
        </div>
    </div>
</body>
</html>