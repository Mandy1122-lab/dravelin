<?php 
    if (isset($_GET["s_id"])) {
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();
        
        $sid = $_GET["s_id"];


        $sql = "DELETE FROM spot WHERE s_id = '$sid'";
        mysqli_query($conn, $sql);

        $sql = "DELETE FROM cspot WHERE s_id = '$sid'";
        mysqli_query($conn, $sql);

        $sql = "SELECT * FROM spotm WHERE s_id = '$s_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
            $delete_sql = "DELETE FROM spotm WHERE s_id = '$s_id'";
            if (mysqli_query($conn, $delete_sql)) {
                echo "成功刪除 spotm 上的相應記錄";
            } else {
                echo "刪除 spotm 上的記錄時出現錯誤：" . mysqli_error($conn);}

        }

        $sql = "SELECT * FROM spotd WHERE s_id = '$s_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
            $delete_sql = "DELETE FROM spotd WHERE s_id = '$s_id'";
            if (mysqli_query($conn, $delete_sql)) {
                echo "成功刪除 spotd 上的相應記錄";
            } else {
                echo "刪除 spotd 上的記錄時出現錯誤：" . mysqli_error($conn);}

        }

        mysqli_close($conn);
        header("Location:spot-manage.php");
        exit();
    
}
?>
