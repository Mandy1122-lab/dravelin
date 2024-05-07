<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>景點管理</title>

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
    include 'header-mng.html'
    ?>
    <!-- Header End -->


    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div>
                <div class="section_title line">
                    <h4>景點列表</h4>
                </div>

                <div class="wrapper">
                    <form class="form-inline my-2 my-lg-0" method="post">
                    <input class="form-control mr-sm-2 search" type="text" placeholder="搜尋景點" aria-label="Search" name="s_name">
                    <button type="submit" name="Search" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <button onclick="window.location.href='spot-add.php'" type="button" class="btn btn-outline-primary my-btn">＋&nbsp;新增景點</button>
                </div>
                    <?php

                    if (isset($_POST["Search"])) {
                        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                        $conn = sql_open();
                        $conditions = array();

                        if (!empty($_POST["s_name"])) {
                            $s_name = "s_name LIKE '%" . mysqli_real_escape_string($conn, $_POST["s_name"]) . "%'";
                            $conditions[] = $s_name;
                        } 

                        $sql = "SELECT s_id, s_name, s_add FROM spot";

                        if (!empty($conditions)) {
                            $sql .= " WHERE " . implode(" AND ", $conditions);
                        }

                        $result = mysqli_query($conn, $sql);

                        echo "<table class='s-tb'>";
                        echo "<tr><th>景點編號</th><th>景點名稱</th><th>地址</th><th>操作</th></tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['s_id']}</td>";
                            echo "<td align='center'>{$row['s_name']}</td>";
                            echo "<td align='center'>{$row['s_add']}</td>";
                            echo '<td align="center"><a href="spot-edit.php?s_id=' . $row['s_id'] . '"><i class="fa-solid fa-pen edit"></i></i></a>&nbsp;&nbsp;&nbsp;<a href="spot-del.php?s_id=' . $row['s_id'] . '"><i class="fa-solid fa-trash trash"></i></a></td>';
                            echo "</tr>";
                        }

                        echo "</table></center>";
                        echo "</div>";
                    
                        mysqli_free_result($result);
                    }else{
                        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                        $conn = sql_open();
                        $sql = "SELECT s_id, s_name, s_add FROM spot";
                        $result = mysqli_query($conn, $sql);

                        echo "<table>";
                        echo "<tr><th>景點編號</th><th>景點名稱</th><th>地址</th><th>操作</th></tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['s_id']}</td>";
                            echo "<td align='center'>{$row['s_name']}</td>";
                            echo "<td align='center'>{$row['s_add']}</td>";
                            echo '<td align="center"><a href="spot-edit.php?s_id=' . $row['s_id'] . '"><i class="fa-solid fa-pen edit"></i></i></a>&nbsp;&nbsp;&nbsp;<a href="spot-del.php?s_id=' . $row['s_id'] . '"onclick="return confirmaction()"><i class="fa-solid fa-trash trash"></i></a></td>';
                            echo "</tr>";
                        }

                        echo "</table></center>";
                        echo "</div>";

                        mysqli_free_result($result);
                    }
                    
            
                    mysqli_close($conn)?>

                
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
<script src="confirm.js"></script>


</body>

</html>
