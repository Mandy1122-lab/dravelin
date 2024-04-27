<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>景點一覽</title>

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
        .simage-container{
            position: relative;
            display: inline-block;
        }
    </style>
</head>

<body class="font_set">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="heading_logo">
                        <a href="./index.html">
                            <!-- <img src="img/logo.png" alt=""> -->
                            Dravelin
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="#">劇集<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="#">Categories</a></li>
                                        <li><a href="#">Anime Details</a></li>
                                        <li><a href="#">Anime Watching</a></li>
                                        <li><a href="#">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">電影<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="#">Categories</a></li>
                                        <li><a href="#">Anime Details</a></li>
                                        <li><a href="#">Anime Watching</a></li>
                                        <li><a href="#">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">拍攝景點<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="#">Categories</a></li>
                                        <li><a href="#">Anime Details</a></li>
                                        <li><a href="#">Anime Watching</a></li>
                                        <li><a href="#">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">活動專區</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <a href="#" class="search-switch"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ffffff;"></i></a>
                        <!-- <a href="./login.html"><span class="icon_profile"></span></a> -->
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
    


    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-6 section_title">
                <h4>熱門景點</h4>
            </div>
            <?php 
            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
            $conn = sql_open();
            $sql = "SELECT hotspot.h_id, spot.s_id, spot.s_name, spot.s_pic FROM hotspot JOIN spot ON hotspot.s_id = spot.s_id ORDER BY hotspot.h_id;";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<div class='hot-wrap'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div>";
                    echo '<a href="spot-info.php?s_id=' . $row['s_id'] . '">';
                    echo "<img class='image' src='{$row['s_pic']}'>";
                    echo "<p class='word'>{$row['s_name']}</p>"; 
                    echo "</a>";
                    echo "</div>";
                }
                echo "</div>";
                mysqli_free_result($result);
            }
            mysqli_close($conn);
            ?>

            <div class="col-lg-8 col-md-8 col-sm-6 section_title">
                <h4 class="c-title">以國家分類</h4>
            </div>
            <div class="country" style="padding-left:40px">
            <?php  
                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                $conn = sql_open();
                $sql = "SELECT * FROM country";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='simage-container'>";
                        echo "<img class='image c-img' src='{$row['c_pic']}'>";
                        echo "<div class='text-overlay'>";
                        echo "<a href='country.php?c_id=" . $row['c_id'] . "'><p style='font-size: 30px;font-weight:bolder;color:#ffffff'>" . $row['c_name'] . "</p></a>";
                        echo "</div>";
                        echo "</div>";
                    }
                    mysqli_free_result($result);
                }
                mysqli_close($conn);
                ?>

                </div> 
            <div class="col-lg-8 col-md-8 col-sm-6 section_title">
                <h4 class="c-title">小編精選合輯</h4>
            </div>
            <div class="editor-rec">
            <?php 
                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                $conn = sql_open();
                $sql = "SELECT * FROM scomplication";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='simage-container'>";
                        echo "<img style='width: 550px !important;height:170px;border-radius: 20px;opacity:0.7' src='" . $row['sc_pic'] . "'>";
                        echo "<div class='text-overlay'>";
                        echo "<a href='list.php?sc_id=" . $row['sc_id'] . "'><p style='font-size: 25px;font-weight:bolder;color:#ffffff'>" . $row['sc_name'] . "</p></a>";
                        echo "</div>";
                        echo "</div>";
                    }
                    mysqli_free_result($result);
                }
                mysqli_close($conn);
                ?>

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
