<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增-景點介紹</title>

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
    echo "<a href='spot-manage.php' style='margin-left:150px'><i class='fa-solid fa-arrow-left fa-xl' style='color: #1d50a1;'></i></a>";

    ?>
    <!-- Header End -->
    <!--新增景點PHP-->
    <?php 
if (isset($_POST["Insert"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    if (!$conn) {
        die("資料庫連線失敗: " . mysqli_connect_error());
    }

    $s_name = $_POST["s_name"];
    $s_add = $_POST["s_add"];
    $s_info = $_POST["s_info"];
    $s_intro = $_POST["s_intro"];
    $s_photo = $_POST["s_photo"];
    $s_pic = $_POST["s_pic"];
    $lat_lon = $_POST["lat_lon"];
    $production_name = $_POST["production_name"];

    
    $sql = "SELECT m_id FROM movie WHERE m_name = '$production_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result);
        $production_id = $row['m_id'];

        
        $sql = "INSERT INTO spot (s_name, s_add, s_info, s_intro, s_photo, s_pic, lat_lon) VALUES ('$s_name', '$s_add', '$s_info', '$s_intro', '$s_photo', '$s_pic', '$lat_lon')";
        mysqli_query($conn, $sql);

        
        $s_id = mysqli_insert_id($conn);

        
        $sql = "INSERT INTO spotm (s_id, m_id) VALUES ('$s_id', '$production_id')";

        
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            echo '<script>window.location.href = "spot-manage.php";</script>';

            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        
        $sql = "SELECT d_id FROM drama WHERE d_name = '$production_name'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_assoc($result);
            $production_id = $row['d_id'];

            
            $sql = "INSERT INTO spot (s_name, s_add, s_info, s_intro, s_photo, s_pic, lat_lon) VALUES ('$s_name', '$s_add', '$s_info', '$s_intro', '$s_photo', '$s_pic', '$lat_lon')";
            mysqli_query($conn, $sql);

            
            $s_id = mysqli_insert_id($conn);

            
            $sql = "INSERT INTO spotd (s_id, d_id) VALUES ('$s_id', '$production_id')";

            
            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                echo '<script>window.location.href = "spot-manage.php";</script>';
                exit();
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }
    }

}
?>




    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container"> 
            <div>
                <div class="section_title line" style='margin-top:-30px'>
                    
                    <h4>新增 - 景點介紹</h4>
                    
                    
                </div>
                <form action="spot-add.php" method="post">
                    <div class="row">
                    <div class="col">
                        <label for="inputEmail4">景點名稱</label>
                        <input type="text" name="s_name" class="form-control" placeholder="請輸入名稱">

                        <label for="inputEmail4" style="margin-top: 25px;">地址</label>
                        <input type="text" name="s_add" class="form-control" placeholder="請輸入地址">
                        <!--step2-->
                        <label for="inputEmail4" style="margin-top: 25px;">景點座標</label>
                        <input type="text" name="lat_lon" class="form-control" placeholder="請輸入座標">

                        <label for="inputEmail4" style="margin-top: 25px;">景點資訊</label>
                        <input type="text" name="s_info" class="form-control" placeholder="請輸入營業時間、電話等資訊">
                        <!--step2-->
                        <label for="inputEmail4" style="margin-top: 25px;">在此取景作品</label><br>
                        <select class="form-control select" id="exampleFormControlSelect1" name="production_name">
                        <?php 
                            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                            $conn = sql_open();
                            $sql = "SELECT d_name AS production_name FROM drama UNION SELECT m_name AS production_name FROM movie";
                            if ($result = mysqli_query($conn, $sql)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['production_name'] . "'>" . $row['production_name'] . "</option>";
                                    
                                }
                                mysqli_free_result($result);
                            }
                            mysqli_close($conn);
                            ?>
                            
                        </select>

                    </div> 
                    <div class="col">
                        <label for="inputEmail4">景點簡介</label>
                        <textarea class="form-control" name="s_intro" placeholder="請輸入內容" rows="5"></textarea>

                        <label for="inputEmail4" style="margin-top: 25px;">相關劇照</label>
                        <input type="text" name="s_photo" class="form-control" placeholder="請輸入位置">

                        <label for="inputEmail4" style="margin-top: 25px;">景點封面圖</label>
                        <input type="text" name="s_pic" class="form-control" placeholder="請輸入位置">
                        <nobr>
                        <button type="reset" onclick="window.location.href='spot-manage.php'" class="btn btn-outline-primary cancel" >取消</button>
                        <button type="submit" name="Insert" class="btn btn-outline-primary save">儲存</button>
                        </nobr>

                    </div>
                    
                    </div>
                </form>
    
                
            </div>
            
        </div>
    </section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="./index.html">Homepage</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

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
