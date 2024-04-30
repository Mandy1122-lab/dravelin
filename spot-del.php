<?php 
    if (isset($_GET["s_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();
        
        $sid = $_GET["s_id"];


        $sql = "DELETE FROM spot WHERE s_id = '$sid'";

        if (mysqli_query($conn, $sql)) {
            echo "刪除成功";
        } else {
            echo "錯誤： " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location:spot-manage.php");
        exit();
    }
?>
