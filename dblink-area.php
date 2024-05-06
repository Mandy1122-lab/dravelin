<?php
header('Content-Type: application/json');  // 確保發送 JSON 回應

$link = mysqli_connect('localhost', 'root', 'fjuim110', 'dravelin');

// Check connection
if (!$link) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . mysqli_connect_error()]);
    exit;
}

$action = $_POST['action'];

if ($action == "save_changes") {
    $area_id = $_POST['area_id'];
    $area_name = $_POST['area_name'];
    $area_pic = $_POST['area_pic'];
    $area_choose = $_POST['area_choose'];

    // 解析 area_choose 來確定連結
    list($type, $l_id) = explode('-list.php?l_id=', $area_choose);
    $pageUrl = ($type == 'drama' ? "drama-list.php?l_id=$l_id" : "movie-list.php?l_id=$l_id");

    $sql = "UPDATE area SET area_name='$area_name', area_pic='$area_pic', area_choose='$pageUrl' WHERE area_id='$area_id'";

    if (mysqli_query($link, $sql)) {
        echo json_encode(["success" => true, "message" => "更新完成"]);
    } else {
        echo json_encode(["success" => false, "message" => "無法更新: " . mysqli_error($link)]);
    }
}

mysqli_close($link);
?>