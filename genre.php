<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php" ;
$conn = sql_open(); 
$sql = "SELECT * FROM genre";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分類</title>

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
    <!--font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <script src="https://kit.fontawesome.com/937e93c93c.js" crossorigin="anonymous"></script>


    <style>
        /* Your custom styles here */
    </style>
</head>

<body class="font_set">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <!-- Your header code here -->
    <!-- Header End -->

    <section class="product-page spad">
        <div class="container">
            <div>
                <div class="section_title">
                    <h4>分類列表</h4>
                </div>

                <div class="wrapper">
                    <button id="addGenreBtn" class="btn btn-outline-primary my-btn">＋&nbsp;新增分類</button>
                </div>

                <?php
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>#</th><th>分類</th><th>操作</th></tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['g_id']}</td>";
                        echo "<td align='center'><span class='edit' data-id='{$row['g_id']}'>{$row['g_name']}</span></td>";
                        echo '<td align="center"><a href="genre-management.php?action=delete&g_id=' . $row['g_id'] . '"><i class="fa-solid fa-trash" style="color: #de2626;"></i></a></td>';
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                mysqli_close($conn);
                ?>

            </div>

        </div>
    </section>

    <!-- Footer Section Begin -->
    <!-- Your footer code here -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('addGenreBtn').addEventListener('click', function () {
                var table = document.querySelector('table');
                var newRow = table.insertRow(table.rows.length - 1);
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                cell1.innerHTML = '-';
                cell2.innerHTML = '<input type="text" id="newGenreName">';
                cell3.innerHTML = '<button id="saveNewGenreBtn">儲存</button>';

                document.getElementById('saveNewGenreBtn').addEventListener('click', function () {
                    var newGenreName = document.getElementById('newGenreName').value;
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'genre-management.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log('Inserted successfully');
                            // Reload the page to show the new data
                            location.reload();
                        }
                    };
                    xhr.send('action=add&g_name=' + newGenreName);
                });
            });
        });
    </script>

</body>

</html>
