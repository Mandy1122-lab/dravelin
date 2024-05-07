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
    echo "<a href='spot-manage.php' style='margin-left:150px'><i class='fa-solid fa-arrow-left fa-xl' style='color: #1d50a1;'></i></a>";

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
                'c_id' => $row['c_id']
            ];
            
            // 查詢 spotm 表是否有符合的資料
            $sql_spotm = "SELECT m_id FROM spotm WHERE s_id = '$s_id'";
            $result_spotm = mysqli_query($conn, $sql_spotm);
            if (mysqli_num_rows($result_spotm) > 0) {
                $row_spotm = mysqli_fetch_assoc($result_spotm);
                $m_id = $row_spotm['m_id'];
                $sql_production_name = "SELECT m_name AS production_name FROM movie WHERE m_id = '$m_id'";
            } else {
                // 如果 spotm 表中沒有符合的資料，則查詢 spotd 表
                $sql_spotd = "SELECT d_id FROM spotd WHERE s_id = '$s_id'";
                $result_spotd = mysqli_query($conn, $sql_spotd);
                if (mysqli_num_rows($result_spotd) > 0) {
                    $row_spotd = mysqli_fetch_assoc($result_spotd);
                    $d_id = $row_spotd['d_id'];
                    $sql_production_name = "SELECT d_name AS production_name FROM drama WHERE d_id = '$d_id'";
                }
            }
    
            // 執行 SQL 查詢以獲取 production_name
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
    $production_name = $_POST["production_name"];
    
    // 查詢電影表中是否有符合的資料
    $sql = "SELECT m_id FROM movie WHERE m_name = '$production_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $production_id = $row['m_id'];
        
        // 更新 spot 表
        $sql = "UPDATE spot SET s_name = '$s_name', s_add = '$s_add', s_intro = '$s_intro', s_info = '$s_info', s_photo = '$s_photo', s_pic = '$s_pic', lat_lon = '$lat_lon' WHERE s_id='$s_id' ";
        mysqli_query($conn, $sql);
        
        // 更新 cspot 表
        $sql = "UPDATE cspot SET c_id = '$c_id' WHERE s_id='$s_id'";
        mysqli_query($conn, $sql);
        
        // 更新 spotm 表
        $sql = "UPDATE spotm SET m_id = '$production_id' WHERE s_id = '$s_id'";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            echo '<script>window.location.href = "spot-manage.php";</script>';
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // 查詢劇集表中是否有符合的資料
        $sql = "SELECT d_id FROM drama WHERE d_name = '$production_name'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $production_id = $row['d_id'];
            
            // 更新 spot 表
            $sql = "UPDATE spot SET s_name = '$s_name', s_add = '$s_add', s_intro = '$s_intro', s_info = '$s_info', s_photo = '$s_photo', s_pic = '$s_pic', lat_lon = '$lat_lon' WHERE s_id='$s_id' ";
            mysqli_query($conn, $sql);
            
            // 更新 cspot 表
            $sql = "UPDATE cspot SET c_id = '$c_id' WHERE s_id='$s_id'";
            mysqli_query($conn, $sql);
            
            // 更新 spotd 表
            $sql = "UPDATE spotd SET d_id = '$production_id' WHERE s_id = '$s_id'";
            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                echo '<script>window.location.href = "spot-manage.php";</script>';
                exit(); 
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "找不到對應的劇集或電影資料";
        }
    }
}

?>


    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div>
                <div class="section_title line" style='margin-top:-30px'>
                    <h4 class="s-edit-del">編輯 - 景點介紹</h4>
                    <button type="button" class="btn btn-outline-primary delete" onclick="return confirmAction(<?php echo $row['s_id']; ?>)">刪除景點</button>
                    <script>
                        function confirmAction(s_id) {
                            
                            var result = confirm("是否確認刪除？");
                            if (result) {
                                window.location.href = 'spot-del.php?s_id=' + s_id;
                            }
                            return false;
                        }
                        </script>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
                    <div class="row">
                    <div class="col">
                        <label for="inputEmail4">景點名稱</label>
                        <input type="text" name="s_name" class="form-control" placeholder="請輸入名稱" value="<?php echo $existingData['s_name'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">地址</label>
                        <input type="text" name="s_add" class="form-control" placeholder="請輸入地址" value="<?php echo $existingData['s_add'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點座標</label>
                        <input type="text" name="lat_lon" class="form-control" placeholder="請輸入座標" value="<?php echo $existingData['lat_lon'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點資訊</label>
                        <input type="text" name="s_info" class="form-control" placeholder="請輸入營業時間、電話等資訊" value="<?php echo $existingData['s_info'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">在此取景作品</label><br>
                        <select class="form-control select" id="exampleFormControlSelect1" name="production_name">
                            <?php 
                            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                            $conn = sql_open();
                            $sql = "SELECT d_name AS production_name FROM drama UNION SELECT m_name AS production_name FROM movie";
                            if ($result = mysqli_query($conn, $sql)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $selected = ($row['production_name'] == $existingData['production_name']) ? 'selected' : ''; 
                                    echo "<option value='" . $row['production_name'] . "' $selected>" . $row['production_name'] . "</option>";
                                }
                                mysqli_free_result($result);
                            }
                            mysqli_close($conn);
                            ?>
                        </select>

                        
                    </div>
                    <div class="col">
                        <label for="inputEmail4">景點簡介</label>
                        <textarea class="form-control" name="s_intro" placeholder="請輸入內容" rows="5"><?php echo $existingData['s_intro']; ?></textarea>


                        <label for="inputEmail4" style="margin-top: 25px;">相關劇照</label>
                        <input type="text" name="s_photo" class="form-control" placeholder="請輸入位置" value="<?php echo $existingData['s_photo'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點封面圖</label>
                        <input type="text" name="s_pic" class="form-control" placeholder="請輸入位置" value="<?php echo $existingData['s_pic'];?>">
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
                        <nobr>
                        <button type="reset" class="btn btn-outline-primary cancel" onclick="window.location.href='spot-manage.php'">取消</button>
                        <button type="submit" name="Update" onclick="return confirmaction()" class="btn btn-outline-primary save">儲存</button>
                        </nobr>

                    </div> 
                    
                    </div>
                </form>
    
                
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
