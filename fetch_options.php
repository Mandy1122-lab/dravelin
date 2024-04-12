<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$options = [];

$options[] = '全部';

$sql = "SELECT g_name FROM genre";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row['g_name'];
    }
}

echo json_encode($options);

mysqli_close($conn);
?>
