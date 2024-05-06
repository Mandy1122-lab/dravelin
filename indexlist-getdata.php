<?php
// 資料庫連接設定
$servername = "localhost";
$username = "root";
$password = "fjuim110";
$dbname = "dravelin";

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 從 POST 請求中獲取片單名稱
$listName = $_POST['listName'];

// 檢查是否收到有效的片單名稱
if (empty($listName)) {
    $response = array('ret' => -1, 'msg' => "未收到有效的片單名稱");
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// 使用 prepared statements 來處理 SQL 查詢，並將片單名稱用單引號括起來
$sql = "SELECT l_id, l_name FROM listdrama WHERE l_name = '$listName' 
        UNION 
        SELECT l_id, l_name FROM listmovie WHERE l_name = '$listName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $listName = $row["l_name"];
} else {
    $response = array('ret' => -1, 'msg' => "未找到片單名稱");
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT l_id, l_name FROM listdrama WHERE l_name = '$listName' 
        UNION 
        SELECT l_id, l_name FROM listmovie WHERE l_name = '$listName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $listName = $row["l_name"];

    // 根據片單名稱中的關鍵字來辨識片單的來源
    if (strpos($listName, '劇集') !== false) {
        // 查詢 listtd 資料表中符合的作品資料
        $sql = "SELECT ld.l_id,ldr.l_name,ld.d_id,d.d_name,d.d_pic,g.g_id,g.g_name 
                FROM listd ld 
                JOIN listdrama ldr ON ld.l_id = ldr.l_id 
                JOIN drama d ON ld.d_id = d.d_id
                JOIN genred gd ON d.d_id = gd.d_id
                JOIN genre g ON gd.d_id = g.g_id WHERE l_name = '$listName'";
        $result = $conn->query($sql);

        // 設置變數
        $itemPic = 'd_pic';
        $itemName = 'd_name';
        $itemId = 'd_id';
        $itemGenre = 'g_name';
        $itemGenreId = 'g_id';
        $itemGenreLink = 'drama-genre.php?g_id=';
        $itemDetailLink = 'drama-detail.php?d_id=';
    } elseif (strpos($listName, '電影') !== false) {
        // 查詢 listtm 資料表中符合的作品資料
        $sql = "SELECT lm.l_id,lme.l_name,lm.m_id,m.m_name, m.m_pic,g.g_id,g.g_name
                FROM listm lm                  
                JOIN listmovie lme ON lm.l_id = lme.l_id 
                JOIN movie m ON lm.m_id = m.m_id
                JOIN genrem gm ON m.m_id = gm.m_id
                JOIN genre g ON gm.m_id = g.g_id WHERE l_name = '$listName'";
        $result = $conn->query($sql);

        // 設置變數
        $itemPic = 'm_pic';
        $itemName = 'm_name';
        $itemId = 'm_id';
        $itemGenre = 'g_name';
        $itemGenreId = 'g_id';
        $itemGenreLink = 'movie-genre.php?g_id=';
        $itemDetailLink = 'movie-detail.php?m_id=';
    } else {
        // 如果片單名稱未包含關鍵字或未被辨識，可以選擇預設行為，例如顯示錯誤訊息或採取其他處理方法
    }

    // 執行作品資料的查詢
    if ($result->num_rows > 0) {
        $Content = '';
        // 遍歷結果集，生成片單內容
        while ($row = $result->fetch_assoc()) {
            $Content .= '<div class="col-lg-auto col-md-auto col-sm-auto">';
            $Content .= '<div class="product__item">';
            $Content .= '<img class="product__item__pic" src="' . $row[$itemPic] . '" alt="' . $row[$itemName] . '">';
            $Content .= '<div class="product__item__text">';
            $Content .= '<ul>';
            $Content .= '<li><a href="' . $itemGenreLink . $row[$itemGenreId] . '" class="genre-link">' . $row[$itemGenre] . '</a></li>'; // 顯示類型
            $Content .= '</ul>';
            $Content .= '<h5><b><a href="' . $itemDetailLink . $row[$itemId] . '" class="detail-link">' . $row[$itemName] . '</a></b></h5>'; // 顯示名稱
            $Content .= '</div>';
            $Content .= '</div>';
            $Content .= '</div>';
        }
    } else {
        $response = array('ret' => -1, 'msg' => "未找到片單資料");
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
} else {
    $response = array('ret' => -1, 'msg' => "未找到片單資料");
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// 將片單標題和內容轉換為 JSON 格式，返回給前端
$response = array('ret' => 0, 'title' => $listName, 'content' => $Content);
echo json_encode($response, JSON_UNESCAPED_UNICODE);

$conn->close();
