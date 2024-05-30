<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <div id="map" style="width: 300px; height:200px;"></div>
    <?php
        if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
        }

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

                    WHERE spot.s_id = 6

                    GROUP BY spot.s_id, spot.s_name, spot.s_add, spot.lat_lon;
                ";
        $result = mysqli_query($conn, $sql);

        $landmark = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            list($lat, $lon) = explode(',', $row['lat_lon']);
            $d_id = !is_null($row['d_ids']) ? explode(',', $row['d_ids']) : [];
            $d_name = !is_null($row['d_names']) ? explode(',', $row['d_names']) : [];
            $m_id = !is_null($row['m_ids']) ? explode(',', $row['m_ids']) : [];
            $m_name = !is_null($row['m_names']) ? explode(',', $row['m_names']) : [];
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
            
        }
    ?>

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
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6r4fhlxKrqtna5R6sZWXR29VBxulwfM8&loading=async&callback=initMap"></script>
</body>
</html>