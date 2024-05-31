<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯-景點介紹</title>

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
        .nav-item a{
            color:black !important;
            background-color:#EEEEEE;
        }
        .tab-content{
            margin:30px auto 30px auto;
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
    <!--原有資料-->
    <?php 
    if (isset($_GET["s_id"])){
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();
        $s_id = $_GET["s_id"];
    
        $sql = "SELECT spot.*, cspot.c_id, country.c_name 
        FROM spot 
        INNER JOIN cspot ON spot.s_id = cspot.s_id 
        INNER JOIN country ON cspot.c_id = country.c_id 
        WHERE spot.s_id = '$s_id';";
    
        $result = mysqli_query($conn,$sql);
        if ($row = mysqli_fetch_assoc($result)){
            $existingData = [
                's_name' => $row['s_name'],
                's_add' => $row['s_add'],
                's_info' => $row['s_info'],
                'lat_lon' => $row['lat_lon'],
                's_intro' => $row['s_intro'],
                's_photo' => $row['s_photo'],
                's_pic' => $row['s_pic'],
                'c_id' => $row['c_id'],
                'frame' => $row['frame']
            ];
 
            $sql_spotm = "SELECT m_id FROM spotm WHERE s_id = '$s_id'";
            $result_spotm = mysqli_query($conn, $sql_spotm);
            if (mysqli_num_rows($result_spotm) > 0) {
                $row_spotm = mysqli_fetch_assoc($result_spotm);
                $m_id = $row_spotm['m_id'];
                $sql_production_name = "SELECT m_name AS production_name FROM movie WHERE m_id = '$m_id'";
            } else {

                $sql_spotd = "SELECT d_id FROM spotd WHERE s_id = '$s_id'";
                $result_spotd = mysqli_query($conn, $sql_spotd);
                if (mysqli_num_rows($result_spotd) > 0) {
                    $row_spotd = mysqli_fetch_assoc($result_spotd);
                    $d_id = $row_spotd['d_id'];
                    $sql_production_name = "SELECT d_name AS production_name FROM drama WHERE d_id = '$d_id'";
                }
            }
    
            if (isset($sql_production_name)) {
                $result_production_name = mysqli_query($conn, $sql_production_name);
                if ($row_production_name = mysqli_fetch_assoc($result_production_name)) {
                    $existingData['production_name'] = $row_production_name['production_name'];
                }
            }
    
        } else {
            echo "找不到對應資料";
            exit();
        }
        mysqli_close($conn);
    }
    
    ?> 

    <!--修改PHP-->
    <?php
if (isset($_POST["Update"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    $s_id = $_POST["s_id"];
    $s_name = $_POST["s_name"];
    $s_add = $_POST["s_add"];
    $lat_lon = $_POST["lat_lon"];
    $s_intro = $_POST["s_intro"];
    $s_info = $_POST["s_info"];
    $s_photo = $_POST["s_photo"];
    $s_pic = $_POST["s_pic"];
    $c_id = $_POST["c_id"];
    $frame = $_POST["frame"];
    
    

    $sql = "SELECT s_id FROM spot WHERE s_id = '$s_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $sql = "UPDATE spot SET s_name = '$s_name', s_add = '$s_add', s_intro = '$s_intro', s_info = '$s_info', s_photo = '$s_photo', s_pic = '$s_pic', lat_lon = '$lat_lon', frame = '$frame' WHERE s_id='$s_id' ";
        mysqli_query($conn, $sql);
        
        $sql = "UPDATE cspot SET c_id = '$c_id' WHERE s_id='$s_id'";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            echo '<script>window.location.href = "spot-manage.php";</script>';
            
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo '<script>window.location.href = "spot-edit.php?s_id=' . $s_id . '";</script>';
        }
        
    }else {
            echo "找不到對應的景點資料";
        }
    }


?>


    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">

                <div class="section_title" style='margin-top:-30px'>
                    <h4 class="s-edit-del">編輯 - 景點介紹</h4>
                </div>
                <div style="margin-left:30px !important;margin-top:-30px">

                    <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" href="#a">介紹</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#b">電影</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#c">劇集</a>
                    </li>
                    </ul>
                </div>
                <div class="tab-content" >
                    <div class="tab-pane fade show active" id="a" style="margin-left: 40px;">
                    <form action="" method="post" style="height:600px !important">
                    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
                    <div class="row">
                    <div class="col">
                        <label for="inputEmail4">景點名稱</label>
                        <input type="text" name="s_name" class="form-control" placeholder="請輸入名稱" value="<?php echo $existingData['s_name'];?>">
                        
                        <div style="display:grid;grid-template-rows:1fr 2fr;margin-top:25px">
                        <label for="inputEmail4" >國家</label>
                        <select class="form-control select" id="country" name="c_id">
                        <?php 
                            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                            $conn = sql_open();
                            $sql = "SELECT c_id, c_name FROM country";
                            if ($result = mysqli_query($conn, $sql)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $selected = ($row['c_id'] == $existingData['c_id']) ? 'selected' : ''; 
                                    echo "<option value='" . $row['c_id'] . "' $selected>" . $row['c_name'] . "</option>";
                                }
                                mysqli_free_result($result);
                            }
                            mysqli_close($conn);
                        ?>
                        
                    </select>

                    </select>
                    </div>

                        <label for="inputEmail4">地址</label>
                        <input type="text" name="s_add" class="form-control" placeholder="請輸入地址" value="<?php echo $existingData['s_add'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點座標</label>
                        <input type="text" name="lat_lon" class="form-control" placeholder="請輸入座標" value="<?php echo $existingData['lat_lon'];?>">
                        
                        <label for="inputEmail4" style="margin-top: 25px">嵌入 Google 地圖</label>
                        <textarea class="form-control" name="frame" placeholder="請輸入 Google 地圖 HTML" rows="1"><?php echo $existingData['frame']; ?></textarea>
                        
                        
                        
                    </div>
                    <div class="col">
                        <label for="inputEmail4" >景點資訊</label>
                        <input type="text" name="s_info" class="form-control" placeholder="請輸入營業時間、電話等資訊" value="<?php echo $existingData['s_info'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點簡介</label>
                        <textarea class="form-control" name="s_intro" placeholder="請輸入內容" rows="5"><?php echo $existingData['s_intro']; ?></textarea>


                        <label for="inputEmail4" style="margin-top: 25px;">相關劇照</label>
                        <input type="text" name="s_photo" class="form-control" placeholder="請輸入位置" value="<?php echo $existingData['s_photo'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點封面圖</label>
                        <input type="text" name="s_pic" class="form-control" placeholder="請輸入位置" value="<?php echo $existingData['s_pic'];?>">
                        
                        <nobr>
                        <button type="reset" class="btn btn-outline-primary cancel" onclick="window.location.href='spot-manage.php'">取消</button>
                        <button type="submit" name="Update" onclick="return confirmaction()" class="btn btn-outline-primary save">儲存</button>
                        </nobr>

                    </div> 
                    
                    </div>
                </form>
                </div> 
                    
                    <!--電影-->
                    <div class="tab-pane fade" id="b" style="margin-left: 40px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;grid-gap:30px">
                    <!--左半（搜尋結果）-->
                    <div>
                    <form class="form-inline my-2 my-lg-0" method="post" > 
                        <!--搜尋框-->
                        
                            <input class="form-control mr-sm-2 search" type="text" name="m_name" placeholder="搜尋欲加入景點之電影" aria-label="Search"><br>
                            <button type="submit" name="b_search" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
    
                    

                        
                        <?php
                            if (isset($_POST["b_search"])) {
                                $s_id = $_GET['s_id'];
                                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                $conn = sql_open();

                                $conditions = array();

                                if (!empty($_POST["m_name"])) {
                                    $m_name = "m_name LIKE '%" . mysqli_real_escape_string($conn, $_POST["m_name"]) . "%'";
                                    $conditions[] = $m_name;
                                }

                                $sql = "SELECT m_id, m_name FROM movie";

                                if (!empty($conditions)) {
                                    $sql .= " WHERE " . implode(" AND ", $conditions);
                                }

                                $result = mysqli_query($conn, $sql);

                                echo "<table class='hs-tb'>";
                                echo "<caption style='caption-side: top;color:#000;font-size:20px;'>搜尋結果</caption>";
                                echo "<tr><th>編號</th><th>電影名稱</th><th>操作</th></tr>";

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['m_id']}</td>";
                                    echo "<td>{$row['m_name']}</td>";
                                    echo "<td><a href='sm-add.php?s_id=" . $s_id . "&m_id=" . $row['m_id'] . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                    echo "</tr>";
                                }

                                echo "</table>";

                                mysqli_free_result($result);
                                mysqli_close($conn);
                            } else {
                                $s_id = $_GET['s_id'];
                                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                $conn = sql_open();
                                $sql = "SELECT movie.m_id, movie.m_name FROM movie LEFT JOIN spotm ON movie.m_id = spotm.m_id AND spotm.s_id = '$s_id' WHERE spotm.s_id IS NULL";
                                if ($result = mysqli_query($conn, $sql)) {
                                    echo "<table>";
                                    echo "<caption style='caption-side: top;color:#000;font-size:20px;'>未被列入景點之電影</caption>";
                                    echo "<thead><tr><th>編號</th><th>電影名稱</th><th>操作</th></tr></thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>{$row['m_id']}</td>";
                                        echo "<td>{$row['m_name']}</td>";
                                        echo "<td><a href='sm-add.php?s_id=" . $s_id . "&m_id=" . $row['m_id'] . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody></table>";

                                    mysqli_free_result($result);
                                }

                                mysqli_close($conn);
                            }
                            ?>

                            </table>
                            </form>
                            </div>
                            

                                
                            
                    <!--右半（目前列表）-->
                    <div>
                        <table>
                            <caption style="caption-side: top;color:#000;font-size:20px;margin-top:40px">目前列表</caption>
                                <tr>
                                    <th>編號</th>
                                    <th>電影名稱</th>
                                    <th>操作</th>
                                </tr>
                                <?php 
                                    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                    $conn = sql_open();
                                    $sql = "SELECT spotm.sm_id, movie.m_name,movie.m_id
                                    FROM spotm
                                    JOIN movie ON spotm.m_id = movie.m_id
                                    WHERE spotm.s_id = '$s_id'
                                    ORDER BY spotm.sm_id;
                                    ";
                                    if ($result = mysqli_query($conn, $sql)) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['m_id']}</td>";
                                            echo "<td>{$row['m_name']}</td>";
                                            echo "<td><a href='sm-del.php?s_id=" . $s_id  . "&sm_id=" . $row['sm_id'] . "' onclick='return confirmaction()'><i class='fa-solid fa-trash trash'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        
                                        echo "</div>";
                        
                                        
                                        mysqli_free_result($result);
                                    }

                                    mysqli_close($conn)
                                    ?>

                                
                            </table>
                            
                            <button style="margin-left:460px" class="btn btn-outline-primary save" onclick="window.location.href='spot-manage.php'">儲存</button>
                    </div>
                    </div>    
                    </div> 
                    
                        <!--劇集-->
                <div class="tab-pane fade" id="c" style="margin-left: 40px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;grid-gap:30px">
                    <!--左半（搜尋結果）-->
                    <div>
                        <!--搜尋框-->
                        <form class="form-inline my-2 my-lg-0" method="post"> 
                            <input class="form-control mr-sm-2 search" type="text" name="d_name" placeholder="搜尋欲加入景點之劇集" aria-label="Search"><br>
                            <button type="submit" name="c_search" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>

                        </form>

                        <?php
                            if (isset($_POST["c_search"])) {
                                $s_id = $_GET['s_id'];
                                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                $conn = sql_open();

                                $conditions = array();

                                if (!empty($_POST["d_name"])) {
                                    $d_name = "d_name LIKE '%" . mysqli_real_escape_string($conn, $_POST["d_name"]) . "%'";
                                    $conditions[] = $d_name;
                                }

                                $sql = "SELECT d_id, d_name FROM drama";

                                if (!empty($conditions)) {
                                    $sql .= " WHERE " . implode(" AND ", $conditions);
                                }

                                $result = mysqli_query($conn, $sql);

                                echo "<table class='hs-tb'>";
                                echo "<caption style='caption-side: top;color:#000;font-size:20px;'>搜尋結果</caption>";
                                echo "<tr><th>編號</th><th>電影名稱</th><th>操作</th></tr>";

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['d_id']}</td>";
                                    echo "<td>{$row['d_name']}</td>";
                                    echo "<td><a href='sd-add.php?s_id=" . $s_id . "&d_id=" . $row['d_id'] . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                    echo "</tr>";
                                }

                                echo "</table>";

                                mysqli_free_result($result);
                                mysqli_close($conn);
                            } else {
                                $s_id = $_GET['s_id'];
                                include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                $conn = sql_open();
                                $sql = "SELECT drama.d_id, drama.d_name FROM drama LEFT JOIN spotd ON drama.d_id = spotd.d_id AND spotd.s_id = '$s_id' WHERE spotd.s_id IS NULL";
                                if ($result = mysqli_query($conn, $sql)) {
                                    echo "<table>";
                                    echo "<caption style='caption-side: top;color:#000;font-size:20px;'>未被列入景點之劇集</caption>";
                                    echo "<thead><tr><th>編號</th><th>劇集名稱</th><th>操作</th></tr></thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>{$row['d_id']}</td>";
                                        echo "<td>{$row['d_name']}</td>";
                                        echo "<td><a href='sd-add.php?s_id=" . $s_id . "&d_id=" . $row['d_id'] . "'><i class='fa-solid fa-plus fa-lg' style='color: #1d50a1;'></i></a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody></table>";

                                    mysqli_free_result($result);
                                }

                                mysqli_close($conn);
                            }
                            ?>

                            </table>
                            </form>
                            </div>
                            

                                
                            
                    <!--右半（目前列表）-->
                    <div>
                        <table>
                            <caption style="caption-side: top;color:#000;font-size:20px;margin-top:40px">目前列表</caption>
                                <tr>
                                    <th>編號</th>
                                    <th>劇集名稱</th>
                                    <th>操作</th>
                                </tr>
                                <?php 
                                    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                                    $conn = sql_open();
                                    $sql = "SELECT spotd.sd_id, drama.d_name,drama.d_id
                                    FROM spotd
                                    JOIN drama ON spotd.d_id = drama.d_id
                                    WHERE spotd.s_id = '$s_id'
                                    ORDER BY spotd.sd_id;
                                    ";
                                    if ($result = mysqli_query($conn, $sql)) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['d_id']}</td>";
                                            echo "<td>{$row['d_name']}</td>";
                                            echo "<td><a href='sd-del.php?s_id=" . $s_id  . "&sd_id=" . $row['sd_id'] . "' onclick='return confirmaction()'><i class='fa-solid fa-trash trash'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        
                                        echo "</div>";
                        
                                        
                                        mysqli_free_result($result);
                                    }

                                    mysqli_close($conn)
                                    ?>

                                
                            </table>
                            
                            <button style="margin-left:460px" class="btn btn-outline-primary save" onclick="window.location.href='spot-manage.php'">儲存</button>
                    </div>
                    </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('#myTab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
<script src="confirm.js"></script>
<script>
        $(document).ready(function() {
            // Check if URL contains a hash value
            const hash = window.location.hash;
            if (hash) {
                // Activate the tab corresponding to the hash value
                $('.nav-link[href="' + hash + '"]').tab('show');
            }

            // Update URL when a tab is clicked
            $('.nav-link').on('click', function() {
                const target = $(this).attr('href');
                window.history.replaceState(null, null, target);
            });
        });
    </script>
    

</body>

</html>
