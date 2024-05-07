<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增 - 景點合輯</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="dec.css" type="text/css">

    <!--font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <script src="https://kit.fontawesome.com/937e93c93c.js" crossorigin="anonymous"></script>
    
</head>

<body class="font_set">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <?php 
    include 'header-mng.html';
    echo "<br>";
    echo "<a href='spot-complication.php' style='margin-left:150px'><i class='fa-solid fa-arrow-left fa-xl' style='color: #1d50a1;'></i></a>";

    ?>
    <!-- Header End -->
    <?php 
if (isset($_POST["Insert"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    
    if (!$conn) {
        die("資料庫連線失敗: " . mysqli_connect_error());
    }

    $sc_name = $_POST["sc_name"];
    $sc_pic = $_POST["sc_pic"];
    $sc_intro = $_POST["sc_intro"];
    
    
    $sql = "INSERT INTO scomplication (sc_name, sc_pic, sc_intro) VALUES ('$sc_name', '$sc_pic', '$sc_intro')";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        echo '<script>window.location.href = "spot-complication.php";</script>';

        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


    <!-- Product Section Begin -->
    <section class="product-page spad" style="margin-top:-30px">
        <div class="container">
            <div>
                <!--標題-->
                <div class="section_title line">
                    <h4>新增 - 景點合輯</h4>
                </div>
                <!--切割版面-->
                <form action="spotcoll-add.php" method="post">
                <div style="display:grid;grid-template-columns:1fr 1fr">
                    <!--左半（搜尋結果）-->
                    <div>
                    <label for="inputEmail4">合輯名稱</label>
                    <input type="text" class="form-control input" placeholder="請輸入名稱" name="sc_name">
                    <label for="inputEmail4" style="margin-top: 25px;" >合輯封面圖</label>
                    <input type="text" class="form-control input" placeholder="請輸入位置" name="sc_pic">
                    <label for="inputEmail4" style="margin-top: 25px;">合輯簡介</label>
                    <textarea class="form-control input" placeholder="請輸入內容" rows="5" style="height: 150px;" name="sc_intro"></textarea>
                    </div>
                    <!--右半（目前列表）-->
                    <div style="padding-top:270px"> 
                        <nobr>
                        <button type="reset" onclick="window.location.href='spot-complication.php'" class="btn btn-outline-primary cancel" >取消</button>
                        <button type="submit" name="Insert" class="btn btn-outline-primary save" >完成</button>
                        </nobr>
                    </div>
                </div>
                </form>    
    
                
            </div>
            
        </div>
    </section>
<!-- Product Section End -->



<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/player.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>
