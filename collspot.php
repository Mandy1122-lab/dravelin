<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯 - 熱門景點</title>

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
            <div>
                <!--標題-->
                <div class="section_title line">
                    <h4>新增 - 景點合輯</h4>
                </div>
                <!--切割版面-->
                <div style="display:grid;grid-template-columns:1fr 1fr">
                    <!--左半（搜尋結果）-->
                    <div>
                        <!--搜尋框-->
                        <form class="form-inline my-2 my-lg-0" method="post"> 
                        <input class="form-control mr-sm-2 search" type="text" name="s_name" placeholder="搜尋欲加入合輯之景點" aria-label="Search"><br>
                        <input class="search-btn"  type="submit" name="Search" value="&#xf002;">
                        </form>

                            <?php
                            session_start();

                            if (isset($_POST["Search"])) {

                                $link = @mysqli_connect('localhost', 'root', 'root', 'dravelin') or die("無法開啟資料庫連接");

                                $conditions = array();

                                if (!empty($_POST["s_name"])) {
                                    $s_name = "s_name LIKE '%" . mysqli_real_escape_string($link, $_POST["s_name"]) . "%'";
                                    $conditions[] = $s_name;
                                }

                                $sql = "SELECT s_id, s_name FROM spot";

                                if (!empty($conditions)) {
                                    $sql .= " WHERE " . implode(" AND ", $conditions);
                                }

                                $result = mysqli_query($link, $sql);

                                echo "<table class='hs-tb'>";
                                echo "<caption style='caption-side: top;color:#000;font-size:20px;'>搜尋結果</caption>";
                                echo "<tr><th>編號</th><th>景點名稱</th><th>操作</th></tr>";
                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['s_id']}</td>";
                                    echo "<td>{$row['s_name']}</td>";
                                    echo "<td><a href='hotspot-add.php?s_id=" . $row['s_id'] . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                    echo "</tr>";
                                }
                                
                                echo "</table>";

                                mysqli_free_result($result);

                                mysqli_close($link);
                            }
                            else{
                                $link = @mysqli_connect('localhost', 'root', 'root', 'dravelin') or die("無法開啟資料庫連接");
                                $sql = "SELECT s_id, s_name FROM spot WHERE s_id NOT IN (SELECT s_id FROM hotspot) ORDER BY s_id;";
                                if ($result = mysqli_query($link, $sql)) {
                                    echo "<table>";
                                    echo "<caption style='caption-side: top;color:#000;font-size:20px;'>未被列入合輯景點</caption>";
                                    echo "<thead><tr><th>編號</th><th>景點名稱</th><th>操作</th></tr></thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>{$row['s_id']}</td>";
                                        echo "<td>{$row['s_name']}</td>";
                                        echo "<td><a href='hotspot-add.php?s_id=" . $row['s_id'] . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                        echo "</tr>";
                                        }
                                                                    
                                        echo "</div>";

                                        mysqli_free_result($result);
                                        }

                                    mysqli_close($link);

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
                                    $link = @mysqli_connect('localhost', 'root', 'root', 'dravelin') or die("無法開啟資料庫連接");
                                    $sql = "SELECT hotspot.h_id, spot.s_id, spot.s_name FROM hotspot JOIN spot ON hotspot.s_id = spot.s_id ORDER BY hotspot.h_id;";
                                    if ($result = mysqli_query($link, $sql)) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['h_id']}</td>";
                                            echo "<td>{$row['s_name']}</td>";
                                            echo "<td><a href='hotspot-del.php?h_id=" . $row['h_id'] . "'><i class='fa-solid fa-trash-can fa-lg' style='color: #de2626;'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        
                                        echo "</div>";
                                    
                                        mysqli_free_result($result);
                                    }

                                    mysqli_close($link)
                                    ?>

                                <!-- <tr>
                                    <td>1</td>
                                    <td>豬米超市</td>
                                    <td><a href=""><i class="fa-solid fa-trash-can fa-lg" style="color: #de2626;"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>SKY 披薩</td>
                                    <td><a href=""><i class="fa-solid fa-trash-can fa-lg" style="color: #de2626;"></i></a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>珍棧神奇小吃</td>
                                    <td><a href=""><i class="fa-solid fa-trash-can fa-lg" style="color: #de2626;"></i></a></td>
                                </tr> -->
                            </table>
                            <!-- <nobr>
                        <button type="reset" class="btn btn-outline-primary cancel" >取消</button>
                        <button type="submit" class="btn btn-outline-primary save" >儲存</button>
                        </nobr> -->
                    </div>
                </div>    
    
                
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

</body>

</html>
