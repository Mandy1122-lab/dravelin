<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>國家</title>

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
    <style>
        
        
        .section_title,.section_title h4{
            margin-bottom: 30px;
            color: #000;
            font-weight: bolder;
            line-height: 21px;
            text-transform: uppercase;
            padding-left: 15px;
            position: relative;
        }
        .image{
            width: 250px !important;
            height:170px;
            border-radius: 20px;
        }
        .form-control{
            border-color: #1d50a1;
            background-color: #F5F4F0;
            width:100px;

        }
        .s-title{
            font-size: 24px;
        }
        .s-content{
            font-size: 20px;
        }
        .s-wrap{
            display: grid;
            grid-template-columns:1fr 4fr;
            width:100%;
            grid-gap:2px
        }
        .drama{
            color:#1D50A1
        }
    </style>
</head>

<body class="font_set">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <?php include 'header.html'?>
    <!-- Header End -->


    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
        <?php 
            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
            $conn = sql_open();
            $c_id = $_GET["c_id"];
            $sql = "SELECT country.c_name, spot.s_name, spot.s_pic, spot.s_info, spot.s_add, spot.s_id
            FROM cspot 
            JOIN spot ON cspot.s_id = spot.s_id 
            JOIN country ON cspot.c_id = country.c_id 
            WHERE country.c_id = '$c_id'";
            if ($result = mysqli_query($conn, $sql)) {
            
                $row = mysqli_fetch_assoc($result);
                $c_name = $row['c_name'];

                echo "<div class='col-lg-8 col-md-8 col-sm-6 section_title' style='display:grid; grid-template-columns: 1fr 5fr;'>";
                echo "<a href='spot.php' style='align-self: center;font-size:24px;color: #1d50a1;'><i class='fa-solid fa-arrow-left' style='color: #1d50a1;'></i>&nbsp;&nbsp;$c_name</i></a>";
                echo "</div>";


            while ($row = mysqli_fetch_assoc($result)) { 
                echo "<div style='display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;'>";
                echo "<div><img style='width: 250px !important;height:170px;border-radius: 20px;' src='{$row['s_pic']}'></div>";
                echo "<div>";
                echo "<p class='s-title'><b>{$row['s_name']}</b></p>";
                echo "<div class='s-wrap'>";
                echo "<p class='s-content'><b>地址</b></p>";
                echo "<p class='s-content'>{$row['s_add']}</p>";
                echo "<p class='s-content'><b>景點資訊</b></p>";
                echo "<p class='s-content'>{$row['s_info']}</p>";
                echo "<p class='s-content'><b>在此取景作品</b></p>";
                echo "<a href='#'><p class='s-content drama'><b>想見你</b></p></a>";
                echo "</div>";
                echo "</div>";
                echo "<div style='position: relative;'><a style='font-size:20px;position:absolute;bottom:12px' href='spot-info.php?s_id=" . $row['s_id'] . "'><i class='fa-solid fa-circle-info' style='color: #1d50a1;'>&nbsp;&nbsp;詳細資訊</i></a></div>";
                echo "</div>";
        
    }

    mysqli_free_result($result);
}
mysqli_close($conn);
?>


            <!-- <div class="col-lg-8 col-md-8 col-sm-6 section_title" style="display:grid; grid-template-columns: 1fr 5fr;">
                
                <a href="spot.php" style="align-self: center;"><i class="fa-solid fa-angles-left fa-xl" style="color: #1d50a1;">&nbsp;&nbsp;台灣</i></a>
                <select style='align-self: center !important;' class='form-control select' id='exampleFormControlSelect1'>
                    <option style='font-size:24px'>選擇城市</option>
                    <option style='font-size:24px'>台北市</option>
                    <option style='font-size:24px'>新北市</option>
                    <option style='font-size:24px'>基隆市</option>
                    <option style='font-size:24px'>桃園市</option>
                    <option style='font-size:24px'>新竹縣</option>
                    <option style='font-size:24px'>其他</option>
                </select>
            </div> -->

            <!-- <div style='display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;'>
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://cdn2.ettoday.net/images/4724/d4724610.jpg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>小半樓 Art Space</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">700台南市中西區民權路一段199巷7號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">營業時間：週三-週六14:00~19:00(週日、一、二公休)</p>
                    <br>
                    <p style="font-size:20px;">電話：0982 816 009</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>
                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
                
            </div>
            <div style="display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;">
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://img.13shaniu.tw/uploads/20200511221842_72.jpeg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>龍泉冰店</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">721台南市麻豆區平等路2-4號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">營業時間：週一、週四-週日08:00~18:00(週二、三公休)</p>
                    <br>
                    <p style="font-size:20px;">電話：06 572 1796</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>
                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
            </div>
            <div style="display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;">
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://vickylife.com/wp-content/uploads/2023/09/台南鍋燒意麵︱閒情茗品屋：在樹蔭下享受鍋燒意麵真的好愜意啊！順便回味一下電視劇想見你的場景-12.jpg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>閒情茗品屋</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">702台南市南區金華路二段57巷97號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">營業時間：週一-週日06:30~18:00(週日到14:00)</p>
                    <br>
                    <p style="font-size:20px;">電話：06 265 1951</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>

                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
            </div>
            <div style="display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;">
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://imgs.gvm.com.tw/upload/gallery/20200414/72130_01.jpg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>鳳和高中</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">736台南市柳營區中山東路二段1330號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">電話：0907 441 271</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>

                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
            </div> -->

            
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
