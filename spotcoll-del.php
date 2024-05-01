<?php 
    if (isset($_GET["sc_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();

        $scid = mysqli_real_escape_string($conn, $_GET["sc_id"]);


        $sql = "DELETE FROM scomplication WHERE sc_id = '$scid'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            echo '<script>window.location.href = "spot-complication.php";</script>';
    
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>