<?php 
    if (isset($_GET["h_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();

        $hid = $_GET["h_id"];


        $sql = "DELETE FROM hotspot WHERE h_id = '$hid'";

        if (mysqli_query($conn, $sql)) {
            echo "刪除成功";
        } else {
            echo "錯誤： " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: hotspot-edit.php");
        exit();
    }
?>