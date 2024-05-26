<?php 
if (isset($_GET["s_id"] ) && isset( $_GET["d_id"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    
    $s_id = $_GET["s_id"];
    $d_id = $_GET["d_id"];

    $sql = "INSERT INTO spotd (s_id , d_id) VALUES ('$s_id','$d_id')";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location:spot-edit.php?s_id=$s_id#c");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} 
?>


