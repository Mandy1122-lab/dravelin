<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>景點資訊</title>

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
    include 'header.html';
    echo "<br>";
    echo "<a href='spot.php' style='margin-left:150px'><i class='fa-solid fa-arrow-left fa-xl' style='color: #1d50a1;'></i></a>";

    ?>
    <!-- Header End -->


    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
        <?php 
            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
            $conn = sql_open();
            $s_id = mysqli_real_escape_string($conn, $_GET["s_id"]);
            $sql = "
            SELECT spot.*, 
            GROUP_CONCAT(DISTINCT drama.d_name ORDER BY drama.d_name SEPARATOR '、') AS drama_names,
            GROUP_CONCAT(DISTINCT movie.m_name ORDER BY movie.m_name SEPARATOR '、') AS movie_names,
            GROUP_CONCAT(DISTINCT drama.d_id ORDER BY drama.d_name SEPARATOR ',') AS d_id,
            GROUP_CONCAT(DISTINCT movie.m_id ORDER BY movie.m_name SEPARATOR ',') AS m_id
            FROM spot
            LEFT JOIN spotd ON spot.s_id = spotd.s_id
            LEFT JOIN drama ON spotd.d_id = drama.d_id
            LEFT JOIN spotm ON spot.s_id = spotm.s_id
            LEFT JOIN movie ON spotm.m_id = movie.m_id
            WHERE spot.s_id = '$s_id'
            GROUP BY spot.s_id, spot.s_name;

            ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='up-wrap' style='margin-top:-30px'>";
                    echo "<div><img class='s-cover' style='width: 360px !important;' src='{$row['s_pic']}'></div>";
                    echo "<div>";
                    echo "<p class='s-topic'><b>{$row['s_name']}</b></p>";
                    echo "<div class='s-info'>";
                    echo "<p class='s-content'><b>地址</b></p>";
                    echo "<p class='s-content'>{$row['s_add']}</b>";
                    echo "<p class='s-content'><b>景點資訊</b></p>";
                    echo "<p class='s-content'>{$row['s_info']}</p>";
                    echo "<p class='s-content'><b>在此取景作品</b></p>";
                    echo "<p class='s-content'><b>";
                    if (!empty($row['drama_names'])) {
                        echo "<a  style='color:#1d50a1 !important;' href='drama-detail.php?d_id=" . $row['d_id'] . "' class='drama'>{$row['drama_names']}</a>";
                    }
                    if (!empty($row['movie_names'])) {
                        echo "<a style='color:#1d50a1 !important;' href='movie-detail.php?m_id=" . $row['m_id'] . "' class='movie'>{$row['movie_names']}</a>";
                    }
                    echo "</b></p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='below-wrap'>";
                    echo "<p class='s-topic bw-s-info'><b>景點簡介</b></p>";
                    echo "<p class='s-content'>{$row['s_intro']}</p>";
                    echo "<p class='s-topic bw-s-info'><b>相關劇照</b></p>";
                    echo "<img class='image bw-s-img' src='{$row['s_photo']}'>";
                    
                }
                mysqli_free_result($result);
            }

            mysqli_close($conn);
            ?>

            <?php 
            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
            $conn = sql_open();
            $s_id = $_GET["s_id"];
            $sql = "
            SELECT id, name, source
            FROM (
                (SELECT d_id AS id, d_name AS name, 'drama' AS source
                FROM drama
                WHERE d_id IN (SELECT d_id FROM spotd WHERE s_id = $s_id)
                ORDER BY RAND())
                UNION ALL
                (SELECT m_id AS id, m_name AS name, 'movie' AS source
                FROM movie
                WHERE m_id IN (SELECT m_id FROM spotm WHERE s_id = $s_id)
                ORDER BY RAND())
            ) AS combined
            ORDER BY RAND()
            LIMIT 1;

            ";
            $result = mysqli_query($conn, $sql);
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $source =$row['source'];
                $s_id = $_GET["s_id"];

                if($source=="drama"){
                    $d_id = $row['id'];
                    echo "<p class='s-topic bw-s-info'><b>更多<a class='drama' style='color:#1D50A1' href='drama-detail.php?d_id=" . $row['id'] . "'>&nbsp;{$row['name']}&nbsp;</a>相關景點</b></p>";
                    $second_query = "SELECT spot.* FROM spot INNER JOIN spotd ON spot.s_id = spotd.s_id WHERE spotd.d_id = $d_id AND spotd.s_id != $s_id ORDER BY RAND() LIMIT 4";
                    


                }
                else{ 
                    $m_id = $row['id'];
                    echo "<p class='s-topic bw-s-info'><b>更多<a class='drama' style='color:#1D50A1' href='movie-detail.php?m_id=" . $row['id'] . "'>&nbsp;{$row['name']}&nbsp;</a>相關景點</b></p>";
                    echo "<br>";
                    $second_query = "SELECT spot.* FROM spot INNER JOIN spotm ON spot.s_id = spotm.s_id WHERE spotm.d_id = $d_id AND spotm.s_id != $s_id ORDER BY RAND() LIMIT 4";
                    

                }
                

                $second_result = mysqli_query($conn, $second_query);

                echo "<div class='s-info-wrap'>";
                
                
                if ($second_result) {
                    while ($second_row = mysqli_fetch_assoc($second_result)) {
                
                        echo "<div>";
                        echo "<div><img class='image' src='" . $second_row['s_pic'] . "'><a href='spot-info.php?s_id=" . $second_row['s_id'] . "'><p class='s-info-word'>" . $second_row['s_name'] . "</p></a></div>";
                        echo "</div>";
                    }
                    mysqli_free_result($second_result);
                }
                
                echo "</div>";
            } 
            
            mysqli_free_result($result);
            mysqli_close($conn);

            ?>
            
            
            
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
