<?php 
if (isset($_GET["s_id"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    
    $sid = $_GET["s_id"];

    $sql = "INSERT INTO hotspot (s_id) VALUES ('$sid')";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location:hotspot-edit.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


