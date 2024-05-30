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
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
        iframe {
            width: 350px;
            height: 200px;
        }
        .map {
            color: #1d50a1 !important;
        }
    </style>
</head>

<body class="font_set">
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <?php include 'header.html'; ?>
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
        GROUP_CONCAT(DISTINCT drama.d_id ORDER BY drama.d_name SEPARATOR ',') AS d_ids,
        GROUP_CONCAT(DISTINCT movie.m_id ORDER BY movie.m_name SEPARATOR ',') AS m_ids
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
                echo "<div class='up-wrap'>";
                echo "<div><img class='s-cover' style='width: 360px !important;' src='{$row['s_pic']}'></div>";
                echo "<div>";
                echo "<p class='s-topic'><b>{$row['s_name']}</b></p>";
                echo "<div class='s-info'>";
                echo "<p class='s-content'><b>地址</b></p>";
                echo "<p class='s-content'>{$row['s_add']}  &nbsp;&nbsp;<a class='map' href='map.php?message={$row['s_name']}' target='_blank'><i class='fa-solid fa-location-dot'></i></a></p>";  
                echo "<p class='s-content'><b>景點資訊</b></p>";
                echo "<p class='s-content'>{$row['s_info']}</p>";
                echo "<p class='s-content'><b>在此取景作品</b></p>";
                echo "<p class='s-content'><b>";

                $links = array();
                
                $drama_names = !empty($row['drama_names']) ? explode('、', $row['drama_names']) : array();
                $drama_ids = !empty($row['d_ids']) ? explode(',', $row['d_ids']) : array();
                if (!empty($row['drama_names'])) {
                    foreach ($drama_names as $index => $d_name) {
                        $links[] = "<a style='color:#1d50a1 !important;' href='drama-detail.php?d_id=" . $drama_ids[$index] . "' class='drama'>{$d_name}</a>";
                    }
                }
                
                $movie_names = !empty($row['movie_names']) ? explode('、', $row['movie_names']) : array();
                $movie_ids = !empty($row['m_ids']) ? explode(',', $row['m_ids']) : array();
                if (!empty($row['movie_names'])) {
                    foreach ($movie_names as $index => $m_name) {
                        $links[] = "<a style='color:#1d50a1 !important;' href='movie-detail.php?m_id=" . $movie_ids[$index] . "' class='movie'>{$m_name}</a>";
                    }
                }
            
                echo implode("、", $links);
                
                echo "</b></p>";

                
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "<div class='below-wrap'>";
                echo "<p class='s-topic bw-s-info'><b>景點簡介</b></p>";
                echo "<p class='s-content'>{$row['s_intro']}</p>";
                echo "<div style='display: grid;grid-template-columns: 1fr 1fr'>";
                
                echo "<div>";
                echo "<p class='s-topic bw-s-info'><b>相關劇照</b></p>";
                echo "<img class='image bw-s-img' src='{$row['s_photo']}'>";
                echo "</div>";
                echo "<div>";
                echo "<p class='s-topic bw-s-info'><b>Google Map</b></p>";
                echo "<div id='map' style='width: 300px; height: 200px;'></div>";
                echo "</div>";
                echo "</div>";
                
            }
            mysqli_free_result($result);
        }

        mysqli_close($conn);
        ?>

        <?php 
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();
        $s_id = $_GET["s_id"];
        $sql = "SELECT s.s_id, s.s_name, s.s_pic
        FROM spot s
        WHERE s.s_id IN (
            SELECT DISTINCT s_id
            FROM (
                SELECT s_id FROM spotd WHERE d_id IN (SELECT d_id FROM spotd WHERE s_id = $s_id)
                UNION ALL
                SELECT s_id FROM spotm WHERE m_id IN (SELECT m_id FROM spotm WHERE s_id = $s_id)
            ) AS temp
            WHERE s_id != $s_id
        )
        LIMIT 4;
        ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<p class='s-topic bw-s-info'><b>更多相關景點</b></p>";
            

            echo "<div class='s-info-wrap'>";
            
            
            
                while ($row = mysqli_fetch_assoc($result)) {
            
                    echo "<div>";
                    echo "<div><img class='image' src='" . $row['s_pic'] . "'><a href='spot-info.php?s_id=" . $row['s_id'] . "'><p class='s-info-word'>" . $row['s_name'] . "</p></a></div>";
                    echo "</div>";
                }
                mysqli_free_result($result);
            
            
            echo "</div>";
        } 
        

        mysqli_close($conn);
        ?>
        </div>
    </section>

<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open();
$s_id = $_GET["s_id"];

$sql = "SELECT spot.s_id,
               spot.s_name,
               spot.s_add,
               spot.lat_lon,
               GROUP_CONCAT(spotm.m_id) AS m_ids,
               GROUP_CONCAT(movie.m_name) AS m_names,
               GROUP_CONCAT(spotd.d_id) AS d_ids,
               GROUP_CONCAT(drama.d_name) AS d_names
        FROM spot
        LEFT JOIN spotm ON spot.s_id = spotm.s_id
        LEFT JOIN movie ON spotm.m_id = movie.m_id
        LEFT JOIN spotd ON spot.s_id = spotd.s_id
        LEFT JOIN drama ON spotd.d_id = drama.d_id
        WHERE spot.s_id = $s_id
        GROUP BY spot.s_id, spot.s_name, spot.s_add, spot.lat_lon";
$result = mysqli_query($conn, $sql);

$landmark = null;
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    list($lat, $lon) = explode(',', $row['lat_lon']);
    $d_id = !empty($row['d_ids']) ? explode(',', $row['d_ids']) : array();
    $d_name = !empty($row['d_names']) ? explode(',', $row['d_names']) : array();
    $m_id = !empty($row['m_ids']) ? explode(',', $row['m_ids']) : array();
    $m_name = !empty($row['m_names']) ? explode(',', $row['m_names']) : array();
    $landmark = [
        'id' => $row['s_id'],
        'description' => $row['s_add'],
        'name' => $row['s_name'],
        'lat' => floatval($lat),
        'lon' => floatval($lon),
        'd_id' => $d_id,
        'd_name' => $d_name,
        'm_id' => $m_id,
        'm_name' => $m_name,
    ];
} ?>


<script>
        function initMap() {
            var landmark = <?php echo json_encode($landmark); ?>;

            var mapOptions = {
                zoom: 16,
                center: new google.maps.LatLng(landmark.lat, landmark.lon),
                styles: [
                    {
                        featureType: "poi",
                        stylers: [{ visibility: "off" }]
                    },
                    {
                        featureType: "transit.station",
                        stylers: [{ visibility: "off" }] 
                    }
                ],
                disableDefaultUI: true
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var currentInfoWindow = null;

            function createMarker(landmark) {
                var infoWindow = new google.maps.InfoWindow({
                    content:  '<b>'+ landmark.name +'</b>',
                });
                
                google.maps.event.addListener(infoWindow, 'domready', function() {
                    var iwCloseBtn = document.querySelector('.gm-ui-hover-effect');
                    if (iwCloseBtn) {
                        iwCloseBtn.style.display = 'none';
                    }
                });

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(landmark.lat, landmark.lon),
                    map: map,
                    title: landmark.name
                });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                    currentInfoWindow = infoWindow;
                });
                return marker;
            }

            map.addListener('click', function() {
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                    currentInfoWindow = null;
                }
            });

            if (landmark) {
                createMarker(landmark);
            }
        }

        window.onload = initMap;
    </script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6r4fhlxKrqtna5R6sZWXR29VBxulwfM8&callback=initMap"></script>

    <!-- Product Section End -->

    <?php include "footer.html"; ?>

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
