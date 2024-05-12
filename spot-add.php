<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增-景點介紹</title>

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
    echo "<br>";
    echo "<a href='spot-manage.php' style='margin-left:150px'><i class='fa-solid fa-arrow-left fa-xl' style='color: #1d50a1;'></i></a>";

    ?>
    <!-- Header End -->
    <!--新增景點PHP-->
    <?php 
if (isset($_POST["Insert"])) {
    include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
    $conn = sql_open();
    if (!$conn) {
        die("資料庫連線失敗: " . mysqli_connect_error());
    }

    $s_name = $_POST["s_name"];
    $s_add = $_POST["s_add"];
    $s_info = $_POST["s_info"];
    $s_intro = $_POST["s_intro"];
    $s_photo = $_POST["s_photo"];
    $s_pic = $_POST["s_pic"]; 
    $lat_lon = $_POST["lat_lon"];
    $c_id = $_POST["c_id"];
    

    $sql = "INSERT INTO spot (s_name, s_add, s_info, s_intro, s_photo, s_pic, lat_lon) VALUES ('$s_name', '$s_add', '$s_info', '$s_intro', '$s_photo', '$s_pic', '$lat_lon')";
        mysqli_query($conn, $sql);

        $s_id = mysqli_insert_id($conn);

        $sql = "INSERT INTO cspot (c_id, s_id) VALUES ('$c_id', '$s_id')";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header("Location: spot-edit.php?s_id=$s_id"); 
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } 
    


?>




    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container"> 
            <div>
                <div class="section_title" style='margin-top:-30px'>
                    <h4>新增 - 景點介紹</h4>
                </div>
                <div style="margin-left:30px !important">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" href="#a">介紹</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="a">
                    </div>
                </div>
                <form action="spot-add.php" method="post">
                    <div class="row">
                    <div class="col">
                        <label for="inputEmail4">景點名稱</label>
                        <input type="text" name="s_name" class="form-control" placeholder="請輸入名稱">

                        <label for="inputEmail4" style="margin-top: 25px;">地址</label>
                        <input type="text" name="s_add" class="form-control" placeholder="請輸入地址">
                        <!--step2-->
                        <label for="inputEmail4" style="margin-top: 25px;">景點座標</label>
                        <input type="text" name="lat_lon" class="form-control" placeholder="請輸入座標">

                        <label for="inputEmail4" style="margin-top: 25px;">景點資訊</label>
                        <input type="text" name="s_info" class="form-control" placeholder="請輸入營業時間、電話等資訊">
                        <!--step2-->
                        <div style="display:grid;grid-template-rows:1fr 2fr;margin-top:25px">
                        <label for="inputEmail4" >國家</label>
                        <select class="form-control select"  id="country" name="c_id" >
                        <?php 
                            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
                            $conn = sql_open();
                            $sql = "SELECT c_id, c_name FROM country";
                            if ($result = mysqli_query($conn, $sql)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['c_id'] . "'>" . $row['c_name'] . "</option>";
                                    
                                }
                                mysqli_free_result($result);
                            }
                            mysqli_close($conn);
                            ?>
                        </select></div>
                        
                        

                    </div> 
                    <div class="col"> 
                        <label for="inputEmail4">景點簡介</label>
                        <textarea class="form-control" name="s_intro" placeholder="請輸入內容" rows="5"></textarea>

                        <label for="inputEmail4" style="margin-top: 25px;">相關劇照</label>
                        <input type="text" name="s_photo" class="form-control" placeholder="請輸入位置">

                        <label for="inputEmail4" style="margin-top: 25px;">景點封面圖</label>
                        <input type="text" name="s_pic" class="form-control" placeholder="請輸入位置">
                        
                        <nobr>
                        <button type="reset" onclick="window.location.href='spot-manage.php'" class="btn btn-outline-primary cancel" >取消</button>
                        <button type="submit" name="Insert" class="btn btn-outline-primary save">儲存</button>
                        </nobr>

                    </div>
                    
                    </div>
                </form>
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
