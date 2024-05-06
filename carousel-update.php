<?php
$servername = "localhost";
$username = "root";
$password = "fjuim110";
$database = "dravelin";

// 創建連接
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$page = $_POST['page']; // 取得頁面編號
$carousel_pic = $_POST['carousel_pic'];
$carousel_link = $_POST['carousel_link'];

// SQL 更新語句
$query = "UPDATE carousel SET carousel_pic = ?, carousel_link = ? WHERE carousel_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssi", $carousel_pic, $carousel_link, $page);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => true, "message" => "更新完成"]);
} else {
    echo json_encode(["success" => false, "message" => "無法更新: " . mysqli_error($conn)]);
}

$stmt->close();
$conn->close();
?>