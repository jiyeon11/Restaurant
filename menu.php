<?php
// 세션 시작
session_start();

// 데이터베이스 연결
$conn = mysqli_connect('localhost', 'root', '111111', 'restaurantDB', '3307');

// 메뉴 정보를 가져오는 쿼리
$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);

// 데이터베이스에서 가져온 메뉴 정보를 배열로 저장
$menus = array();
while ($row = mysqli_fetch_assoc($result)) {
    $menus[] = $row;
}

// 데이터베이스 연결 닫기
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메뉴</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f5f5f5;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .menu-item {
            margin: 20px;
            text-align: center;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: 350px;
        }
        .menu-item:hover {
            transform: scale(1.1); /* 블럭이 1.1배 확대됨 */
            transition: transform 0.3s ease; /* 부드러운 전환 효과를 위해 transition 속성 추가 */
        }
        .menu-image {
            width: 300px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .menu-name {
            font-weight: bold;
            margin: 10px 0;
        }
        .menu-description {
            color: #555;
        }
        .menu-header {
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 10px 20px;
            background-color: #E2E2E2;
        }
        .menu-header a {
            margin: 0 20px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">이랏샤이마세</h2>
    <div class="menu-header">
        <div>
            <a href="reservation.html">예약하러 가기</a>
            <a href="reviews.html">리뷰보기</a>
            <?php if(isset($_SESSION['user'])){?>
                <a href="myPage.php">마이페이지</a>
                <a href="logOut.php">로그아웃</a>
            <?php } else { ?>
                <a href="login.html">로그인</a>
                <a href="joinUs.html">회원가입</a>
            <?php } ?>
            
        </div>
    </div>
    <h2>메뉴</h2>
    <div class="menu-container">
        <?php foreach ($menus as $menu) : ?>
            <div class="menu-item">
                <img class="menu-image" src="<?php echo $menu['img']; ?>" alt="메뉴 이미지">
                <p class="menu-name"><?php echo $menu['name']; ?></p>
                <p class="menu-description"><?php echo $menu['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
