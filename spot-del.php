<?php 
    if (isset($_GET["s_id"])) {
        $link = @mysqli_connect('localhost', 'root', 'root', 'dravelin') or die("無法開啟資料庫連接");

        $sid = mysqli_real_escape_string($link, $_GET["s_id"]);


        $sql = "DELETE FROM spot WHERE s_id = '$sid'";

        if (mysqli_query($link, $sql)) {
            echo "刪除成功";
        } else {
            echo "錯誤： " . $sql . "<br>" . mysqli_error($link);
        }

        mysqli_close($link);
        header("Location: spot-manage.php");
        exit();
    }
?>