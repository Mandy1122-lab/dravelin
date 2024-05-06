<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open(); 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['sql'])) {
        $sql = $_GET['sql'];

        $result = mysqli_query($conn, $sql);

        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }

        echo json_encode($response);
    } else {
        echo "Invalid SQL query";
    }
}
?>
