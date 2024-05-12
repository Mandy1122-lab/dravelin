<?php 
if (isset($_GET["s_id"] ) && isset( $_GET["m_id"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    
    $s_id = $_GET["s_id"];
    $m_id = $_GET["m_id"];

    $sql = "INSERT INTO spotm (s_id , m_id) VALUES ('$s_id','$m_id')";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location:spot-edit.php?s_id=$s_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


