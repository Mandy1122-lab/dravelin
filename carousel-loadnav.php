<?php
// 連接到資料庫
$link = mysqli_connect('localhost', 'root', 'fjuim110', 'dravelin');

// 檢查是否成功連接到資料庫
if (!$link) {
    die('連接失敗: ' . mysqli_connect_error());
}

// 獲取用戶所請求的分頁編號
$pageNumber = $_GET['page'];

// 根據分頁編號執行相應的查詢
if ($pageNumber == 1) {
    $query = "SELECT * FROM carousel WHERE carousel_id = 1"; // 第一頁的查詢語句
} else if ($pageNumber == 2) {
    $query = "SELECT * FROM carousel WHERE carousel_id = 2"; // 第二頁的查詢語句
} else if ($pageNumber == 3) {
    $query = "SELECT * FROM carousel WHERE carousel_id = 3"; // 第三頁的查詢語句
} else if ($pageNumber == 4) {
    $query = "SELECT * FROM carousel WHERE carousel_id = 4"; // 第四頁的查詢語句
} else {
    // 如果請求的分頁編號無效，你可以返回一個錯誤消息或默認資料
    echo "無效的分頁編號";
    exit;
}

// 執行查詢
$result = mysqli_query($link, $query);

// 檢查是否成功執行查詢
if (!$result) {
    die('查詢失敗: ' . mysqli_error($link));
}

// 解析查詢結果並生成 HTML 代碼
$row = mysqli_fetch_assoc($result);
$imageUrl = htmlspecialchars($row['carousel_pic']);
$connectworkLink = htmlspecialchars($row['carousel_link']);

// 返回 HTML 代碼
echo '<div style="flex: 1; margin-top: 10px; margin-bottom: 5px; width: 500px;">'; // 添加 margin-bottom
echo '<input type="hidden" name="page" value="' . $pageNumber . '">';
echo '<h6 class="text-size">封面圖片</h6>';
echo '<input type="text" name="carousel_pic" placeholder="圖片網址" value="' . $imageUrl . '" style="border: 1px solid #1D50A1; width:70%; height:35px; background-color:#F5F4F0; color: black;">';
echo '</div>';
echo '<div style="flex: 1; margin-top: 0px; width: 500px;">'; // 確保頂部外邊距為0
echo '<h6 class="text-size">連結作品（範例：drama-detail.php?d_id=3）</h6>';
echo '<input type="text" name="carousel_link" placeholder="作品連結" value="' . $connectworkLink . '" style="border: 1px solid #1D50A1; width:70%; height:35px; background-color:#F5F4F0; color: black;">';
echo '</div>';


// 釋放結果集
mysqli_free_result($result);

// 關閉資料庫連接
mysqli_close($link);
?>