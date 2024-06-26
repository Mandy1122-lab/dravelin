<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>景點合輯</title>

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
        
        .heading_logo,.heading_logo a{
            color: white;
            font-weight: bold;
            font-size: 30px;
            margin-top: 7px;
        }
        .section_title{
            margin-bottom: 30px;
            color: #000;
            font-weight: 600;
            line-height: 21px;
            text-transform: uppercase;
            padding-left: 20px;
            position: relative;
        }
        .section_title,.section_title h4{
            margin-bottom: 30px;
            color: #000;
            font-weight: bolder;
            line-height: 21px;
            text-transform: uppercase;
            padding-left: 15px;
            position: relative;
        }
        .section_title{
            border-bottom: 1px solid;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            }

        td, th {
            border: 1px solid #B1B1B1;
            text-align: left;
            padding: 8px;
            text-align: center;
            }

        tr:nth-child(even) {
            background-color: #dddddd;
            }
        tr th,tr:nth-child(odd){
            background-color: #f5f5f5;
        }
        .my-btn{
            background-color: #F5F4F0;
            border-color: #1d50a1;
            color:#1d50a1;
            font-size: 18;
            font-weight: bold;
            margin-left: 84%;
            width: 120px;

        }
        .my-btn:hover{
            background-color: #1d50a1;
            border-color: #1d50a1;
            color: #f5f4f0;
        }
        .my-btn:active{
            background-color: #1d50a1 !important;
            border-color: #1d50a1 !important;
            color: #f5f4f0 !important;
        }
        .wrapper{
            display: grid;
            grid-template-columns: 1fr 2fr;
            margin-bottom: 15px;
        }
        .search{
            max-width: 150px;
            background-color: #D9D9D9;
            border-color: #1d50a1;
            font-family: Inter;
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
    include 'header-mng.html';
    
    ?>
    <!-- Header End -->


    <!-- Product Section Begin -->
    <section class="product-page spad" style="margin-top:-30px !important">
        <div class="container">
            <div>
                <div class="section_title line">
                    <h4>景點列表-小編精選合輯</h4>
                </div>
                <div class="wrapper">
                    <form class="form-inline my-2 my-lg-0" method="post">
                    <input class="form-control mr-sm-2 search" type="text" placeholder="搜尋合輯" aria-label="Search" name="sc_name">
                    <button type="submit" name="Search" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <button onclick="window.location.href='spotcoll-add.php'" type="button" class="btn btn-outline-primary my-btn">＋&nbsp;新增合輯</button>
                </div>
    
                <?php

                    if (isset($_POST["Search"])) {
                        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                        $conn = sql_open();
                        $conditions = array();

                        if (!empty($_POST["sc_name"])) {
                            $sc_name = "sc_name LIKE '%" . mysqli_real_escape_string($conn, $_POST["sc_name"]) . "%'";
                            $conditions[] = $sc_name;
                        } 

                        $sql = "SELECT sc_id, sc_name FROM scomplication";

                        if (!empty($conditions)) {
                            $sql .= " WHERE " . implode(" AND ", $conditions);
                        }

                        $result = mysqli_query($conn, $sql);

                        echo "<table class='s-tb'>";
                        echo "<tr><th>合輯編號</th><th>合輯名稱</th><th>操作</th></tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['sc_id']}</td>";
                            echo "<td align='center'>{$row['sc_name']}</td>";
                            echo '<td align="center"><a href="spotcoll-edit.php?sc_id=' . $row['sc_id'] . '"><i class="fa-solid fa-pen edit"></i></i></a>&nbsp;&nbsp;&nbsp;<a href="spotcoll-del.php?sc_id=' . $row['sc_id'] . '" onclick="return confirmaction()"><i class="fa-solid fa-trash trash"></i></a>&nbsp;&nbsp;&nbsp;<a href="spotcoll.php?sc_id=' . $row['sc_id'] . '"><i class="fa-solid fa-location-dot" style="color: #fed566;"></i></a></td>';
                            
                            
                            echo "</tr>";
                        }

                        echo "</table></center>";
                        echo "</div>";
                    
                        mysqli_free_result($result);
                    }else{
                        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                        $conn = sql_open();

                        $sql = "SELECT sc_id, sc_name FROM scomplication";
                        $result = mysqli_query($conn, $sql);

                        echo "<table>";
                        echo "<tr><th>合輯編號</th><th>合輯名稱</th><th>操作</th></tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['sc_id']}</td>";
                            echo "<td align='center'>{$row['sc_name']}</td>";
                            echo '<td align="center"><a href="spotcoll-edit.php?sc_id=' . $row['sc_id'] . '"><i class="fa-solid fa-pen edit"></i></i></a>&nbsp;&nbsp;&nbsp;<a href="spotcoll-del.php?sc_id=' . $row['sc_id'] . '" onclick="return confirmaction()"><i class="fa-solid fa-trash trash"></i></a>&nbsp;&nbsp;&nbsp;<a href="spotcoll.php?sc_id=' . $row['sc_id'] . '"><i class="fa-solid fa-location-dot" style="color: #fed566;"></i></a></td>';
                            
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
