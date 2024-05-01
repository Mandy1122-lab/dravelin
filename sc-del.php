<?php 
    if (isset($_GET["spc_id"]) && isset($_GET["sc_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();

        $spcid = $_GET["spc_id"];
        $scid = $_GET["sc_id"];

        $sql = "DELETE FROM spotcoll WHERE spotcoll.spc_id = '$spcid'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            echo '<script>window.location.href = "spotcoll.php?sc_id=$scid";</script>';
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }
?>
