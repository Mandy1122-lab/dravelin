<?php 
    if (isset($_GET["s_id"] ) && isset($_GET["sm_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();

        $s_id = $_GET["s_id"];
        $sm_id = $_GET["sm_id"];


        $sql = "DELETE FROM spotm WHERE sm_id = '$sm_id'";

        if (mysqli_query($conn, $sql)) {
            echo "刪除成功";
        } else {
            echo "錯誤： " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location:spot-edit.php?s_id=$s_id#b");
        exit();
    }
?>
