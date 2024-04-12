<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ";
$sql .= "CASE ";
$sql .= "WHEN d.d_name IS NOT NULL THEN d.d_name ";
$sql .= "WHEN m.m_name IS NOT NULL THEN m.m_name ";
$sql .= "END AS name, ";
$sql .= "CASE ";
$sql .= "WHEN d.d_pic IS NOT NULL THEN d.d_pic ";
$sql .= "WHEN m.m_pic IS NOT NULL THEN m.m_pic ";
$sql .= "END AS img ";
$sql .= "FROM genre g ";

$sql .= "LEFT JOIN genred gd ON g.g_id = gd.g_id ";
$sql .= "LEFT JOIN drama d ON gd.d_id = d.d_id ";

$sql .= "LEFT JOIN genrem gm ON g.g_id = gm.g_id ";
$sql .= "LEFT JOIN movie m ON gm.m_id = m.m_id ";

$sql .= "WHERE 1=1 ";

if (!empty($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == '全部') {

    } elseif ($type == '劇集') {
        $sql .= "AND d.d_name IS NOT NULL ";
    } elseif ($type == '電影') {
        $sql .= "AND m.m_name IS NOT NULL ";
    }
}

if (!empty($_GET['genre']) && $_GET['genre'] != '全部') {
    $genre = $_GET['genre'];
    $sql .= "AND g.g_name = '$genre' ";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="' . $row["img"] . '">';
        echo '<h3>' . $row["name"] . '</h3>';
        echo '</div>';
    }
} else {
    echo "查無結果";
}

mysqli_close($conn);
?>
