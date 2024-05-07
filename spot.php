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
    <?php 
        require 'header.html';
    ?>
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
                echo "<div class='hot-wrap line'>";
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
            <div style="width: 100%;display: grid;grid-template-columns: 1fr 1fr 1fr 1fr;grid-gap:30px;margin:auto auto auto 30px;">
            <?php 
                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                $conn = sql_open();
                $sql = "SELECT * FROM country";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='simage-container'>";
                        echo "<img class=' c-img' style='width: 250px !important;height:170px;border-radius: 20px;' src='{$row['c_pic']}'>";
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
<?php 
    include 'footer.html';
?>
<!-- Footer Section End -->



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
