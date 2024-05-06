<?php
$servername = "localhost";
$username = "root";
$password = "fjuim110";
$dbname = "dravelin";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$conn->autocommit(FALSE); // 開啟事務

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true); // true 轉換為關聯數組

$listName = $input['listName'];
$items = $input['items'];

// 刪除舊內容
$sql_delete_items = "DELETE FROM displayitems";
$stmt_delete = $conn->prepare($sql_delete_items);
if (!$stmt_delete->execute()) {
    echo json_encode(["success" => false, "message" => "刪除舊內容失敗: " . $stmt_delete->error]);
    $conn->rollback(); // 回滚事務
    exit;
}
$stmt_delete->close();

// 刪除舊片單
$sql_delete_list = "DELETE FROM displaylist";
$stmt_delete = $conn->prepare($sql_delete_list);
if (!$stmt_delete->execute()) {
    echo json_encode(["success" => false, "message" => "刪除舊片單失敗: " . $stmt_delete->error]);
    $conn->rollback(); // 回滚事務
    exit;
}
$stmt_delete->close();

// 插入新片單
$sql_insert_list = "INSERT INTO displaylist (list_name) VALUES (?)";
$stmt_insert = $conn->prepare($sql_insert_list);
$stmt_insert->bind_param("s", $listName);
if (!$stmt_insert->execute()) {
    echo json_encode(["success" => false, "message" => "插入片单失敗: " . $stmt_insert->error]);
    $conn->rollback(); // 回滚事務
    exit;
}
$list_id = $stmt_insert->insert_id;
$new_list_id = $stmt_insert->insert_id;
$stmt_insert->close();

// 添加新内容
$sql_insert_item = "INSERT INTO displayitems (list_id, item_poster, item_name, detail_link, item_genre, genre_link) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_item = $conn->prepare($sql_insert_item);
foreach ($items as $item) {
    $stmt_item->bind_param("isssss", $list_id, $item['poster'], $item['name'], $item['detailLink'], $item['genre'], $item['genreLink']);
    if (!$stmt_item->execute()) {
        echo json_encode(["success" => false, "message" => "插入作品失敗: " . $stmt_item->error]);
        $conn->rollback(); // 回滾事務
        exit;
    }
}
$stmt_item->close();


$conn->commit(); // 提交事務
$conn->close();

echo json_encode(["success" => true, "message" => "數據已保存"]);
?>