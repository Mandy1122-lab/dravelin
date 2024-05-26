<?php 
    if (isset($_GET["s_id"] ) && isset($_GET["sd_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();

        $s_id = $_GET["s_id"];
        $sd_id = $_GET["sd_id"];


        $sql = "DELETE FROM spotd WHERE sd_id = '$sd_id'";

        if (mysqli_query($conn, $sql)) {
            echo "刪除成功";
        } else {
            echo "錯誤： " . $sql . "<br>" . mysqli_error($conn);
        }
 
        mysqli_close($conn);
        header("Location:spot-edit.php?s_id=$s_id#c");
        exit;
    }
?> 
