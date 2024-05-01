<?php 
if (isset($_GET["s_id"]) && isset($_GET["sc_id"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    
    $scid = $_GET["sc_id"];
    $sid = $_GET["s_id"];

    $sql = "INSERT INTO spotcoll (sc_id, s_id) VALUES ('$scid', '$sid')";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: spotcoll.php?sc_id=$scid");

        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

?>


