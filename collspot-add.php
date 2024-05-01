<?php 
if (isset($_GET["s_id"])) {
    $link = @mysqli_connect('localhost', 'root', 'root', 'dravelin') or die("無法開啟資料庫連接");
    
    $sid = mysqli_real_escape_string($link, $_GET["s_id"]);

    $sql = "INSERT INTO collspot (s_id) VALUES ('$sid')";
    
    if (mysqli_query($link, $sql)) {
        mysqli_close($link);
        header("Location:collspot.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}
?>


