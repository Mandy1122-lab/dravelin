<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增 - 合輯中景點</title>

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
        
        
        
        table {
            border-collapse: collapse;
            width: 90%;
            }

            td, th {
            border: 1px solid #B1B1B1;
            text-align: left;
            padding: 8px;
            text-align: center;
            }

        tr:nth-child(odd) {
            background-color: #dddddd;
            }
        tr th,tr:nth-child(even){
            background-color: #f5f5f5;
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
    echo "<br>";
    echo "<a href='spot-complication.php' style='margin-left:150px'><i class='fa-solid fa-arrow-left fa-xl' style='color: #1d50a1;'></i></a>";

    ?>
    <!-- Header End -->


    <!-- Product Section Begin -->
    <section class="product-page spad" style="margin-top:-30px">
        <div class="container">
            <div>
                <!--標題-->
                <div class="section_title line">
                    <h4>新增 - 合輯中景點</h4>
                </div>
                <!--切割版面-->
                <div style="display:grid;grid-template-columns:1fr 1fr">
                    <!--左半（搜尋結果）-->
                    <div>
                        <!--搜尋框-->
                        <form class="form-inline my-2 my-lg-0" method="post"> 
                        
                    
                        <input class="form-control mr-sm-2 search" type="text" name="s_name" placeholder="搜尋欲加入合輯之景點" aria-label="Search"><br>
                        <button type="submit" name="Search" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>

                        </form>

                            <?php
                            
                            if (isset($_POST["Search"])) {
                                $sc_id = $_GET['sc_id'];
                            
                                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                $conn = sql_open();
                            
                                $conditions = array();
                            
                                if (!empty($_POST["s_name"])) {
                                    $s_name = "s_name LIKE '%" . $_POST["s_name"] . "%'";
                                    $conditions[] = $s_name;
                                }
                            
                                $sql = "SELECT spot.s_id, spot.s_name 
                                        FROM spot 
                                        WHERE spot.s_id NOT IN (SELECT spotcoll.s_id FROM spotcoll JOIN scomplication ON spotcoll.sc_id = scomplication.sc_id WHERE scomplication.sc_id = '$sc_id')";
                            
                                if (!empty($conditions)) {
                                    $sql .= " AND " . implode(" AND ", $conditions); 
                                }
                            
                                $result = mysqli_query($conn, $sql);
                            
                                echo "<table class='hs-tb'>";
                                echo "<caption style='caption-side: top;color:#000;font-size:20px;'>搜尋結果</caption>";
                                echo "<tr><th>編號</th><th>景點名稱</th><th>操作</th></tr>";
                            
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['s_id']}</td>";
                                    echo "<td>{$row['s_name']}</td>";
                                    echo "<td><a href='sc-add.php?s_id=" . $row['s_id']  . "&sc_id=" . $sc_id . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                    echo "</tr>";
                                }
                            
                                echo "</table>";
                            
                                mysqli_free_result($result);
                            
                                mysqli_close($conn);
                            }
                            else{
                                if (isset($_GET["sc_id"])){
                                    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                    $conn = sql_open();
                                    $sc_id = $_GET["sc_id"]; 
                                
                                    $sql = "SELECT spot.s_id, spot.s_name 
                                            FROM spot 
                                            WHERE spot.s_id NOT IN (SELECT spotcoll.s_id FROM spotcoll JOIN scomplication ON spotcoll.sc_id = scomplication.sc_id WHERE scomplication.sc_id = '$sc_id')";
                                
                                    if ($result = mysqli_query($conn, $sql)) {
                                        echo "<table>";
                                        echo "<caption style='caption-side: top;color:#000;font-size:20px;'>未被列入合輯景點</caption>";
                                        echo "<thead><tr><th>編號</th><th>景點名稱</th><th>操作</th></tr></thead>";
                                        echo "<tbody>";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['s_id']}</td>";
                                            echo "<td>{$row['s_name']}</td>";
                                            echo "<td><a href='sc-add.php?s_id=" . $row['s_id'] . "&sc_id=" . $sc_id . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                
                                        mysqli_free_result($result);
                                    }
                                
                                    mysqli_close($conn);
                                }
                                
                            }
                            ?>
                            </table>
                            </form>
                            </div>
                            <!-- <caption style="caption-side: top;color:#000;font-size:20px">搜尋結果</caption>
                                <tr>
                                    <th>編號</th>
                                    <th>景點名稱</th>
                                    <th>操作</th>
                                </tr>
                                
                            </table>  -->
                            <!--未被加入熱門的景點-->
                            

                                
                            
                    <!--右半（目前列表）-->
                    <div>
                        <table>
                            
                            <caption style="caption-side: top;color:#000;font-size:20px">目前列表</caption>
                                <tr>
                                    <th>編號</th>
                                    <th>景點名稱</th>
                                    <th>操作</th>
                                </tr>
                                <?php 
                                    if (isset($_GET["sc_id"])) {
                                        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                        $conn = sql_open();
                                        $sc_id = $_GET["sc_id"];
                                    
                                        $sql = "SELECT spot.s_id, spot.s_name, spotcoll.spc_id 
                                                FROM scomplication 
                                                JOIN spotcoll ON scomplication.sc_id = spotcoll.sc_id 
                                                JOIN spot ON spotcoll.s_id = spot.s_id 
                                                WHERE scomplication.sc_id = '$sc_id'";
                                                
                                        if ($result = mysqli_query($conn, $sql)) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>{$row['s_id']}</td>";
                                                echo "<td>{$row['s_name']}</td>";
                                                echo "<td><a href='sc-del.php?spc_id=" . $row['spc_id'] . "&sc_id=" . $sc_id . "' onclick='return confirmaction()'><i class='fa-solid fa-trash-can fa-lg' style='color: #de2626;'></i></a></td>";
                                                echo "</tr>";
                                            }
                                    
                                            echo "</div>";
                                            
                                            mysqli_free_result($result);
                                        }
                                    
                                        mysqli_close($conn);
                                    }
                                    
                                    ?>

                                
                            </table>
                            <button style="margin-left:460px" class="btn btn-outline-primary save" onclick="window.location.href='spot-complication.php'">儲存</button>
                            
                    </div>
                </div>    
    
                
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
<script src="confirm.js"></script>

</body>

</html>
