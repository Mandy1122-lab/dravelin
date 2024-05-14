<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>合輯</title>

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
        
        
        .section_title,.section_title h4{
            margin-bottom: 30px;
            color: #000;
            font-weight: bolder;
            line-height: 21px;
            text-transform: uppercase;
            padding-left: 15px;
            position: relative;
        }
        .image{
            width: 250px !important;
            height:170px;
            border-radius: 20px;
        }
        .form-control{
            border-color: #1d50a1;
            background-color: #F5F4F0;
            width:100px;

        }
        .s-title{
            font-size: 24px;
        }
        .s-content{
            font-size: 20px;
        }
        .s-wrap{
            display: grid;
            grid-template-columns:1fr 4fr;
            width:100%;
            grid-gap:2px
        }
        .drama{
            color:#1D50A1
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
        include 'header.html';
    ?> 
    <!-- Header End -->

    
    
    <!-- Product Section Begin -->
    <section class="product-page spad">
    

        <div class="container">
        

        <?php 
            include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
            $conn = sql_open();
            $sc_id = $_GET["sc_id"];
            $sql = "SELECT scomplication.sc_name, spot.s_name, spot.s_pic, spot.s_info, spot.s_add, spot.s_id, production_name
            FROM spotcoll 
            JOIN spot ON spotcoll.s_id = spot.s_id 
            JOIN scomplication ON spotcoll.sc_id = scomplication.sc_id 
            LEFT JOIN (
            SELECT spotd.s_id, drama.d_name AS production_name
            FROM spotd 
            JOIN drama ON spotd.d_id = drama.d_id
            UNION
            SELECT spotm.s_id, movie.m_name AS production_name
            FROM spotm
            JOIN movie ON spotm.m_id = movie.m_id
            ) AS production ON spot.s_id = production.s_id
            WHERE scomplication.sc_id = '$sc_id'";
            if ($result = mysqli_query($conn, $sql)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    $sc_name = $row['sc_name'];
                    echo "<div class='col-lg-8 col-md-8 col-sm-6 section_title' style='margin-top:-30px'>";
                    echo "<p class='s-title' style='align-self: center;color: #1d50a1;'><b>$sc_name</b></p>";
                    
                    echo "</div>";
            
                    do {
                        echo "<div style='display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;'>";
                        echo "<div><img style='width: 250px !important;height:170px;border-radius: 20px;' src='{$row['s_pic']}'></div>";
                        echo "<div>";
                        echo "<p class='s-title'><b>{$row['s_name']}</b></p>";
                        echo "<div class='s-wrap'>";
                        echo "<p class='s-content'><b>地址</b></p>";
                        echo "<p class='s-content'>{$row['s_add']}</p>";
                        echo "<p class='s-content'><b>景點資訊</b></p>";
                        echo "<p class='s-content'>{$row['s_info']}</p>";
                        echo "<p class='s-content'><b>在此取景作品</b></p>";
                        echo "<a href='#'><p class='s-content drama'><b>{$row['production_name']}</b></p></a>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div style='position: relative;'><a style='font-size:20px;position:absolute;bottom:12px' href='spot-info.php?s_id=" . $row['s_id'] . "'><i class='fa-solid fa-circle-info' style='color: #1d50a1;'>&nbsp;&nbsp;詳細資訊</i></a></div>";
                        echo "</div>";
                    } while ($row = mysqli_fetch_assoc($result));
                }
            
                mysqli_free_result($result);
            }
            mysqli_close($conn);
            
?>


            <!-- <div class="col-lg-8 col-md-8 col-sm-6 section_title" style="display:grid; grid-template-columns: 1fr 5fr;">
                
                <a href="spot.php" style="align-self: center;"><i class="fa-solid fa-angles-left fa-xl" style="color: #1d50a1;">&nbsp;&nbsp;台灣</i></a>
                <select style='align-self: center !important;' class='form-control select' id='exampleFormControlSelect1'>
                    <option style='font-size:24px'>選擇城市</option>
                    <option style='font-size:24px'>台北市</option>
                    <option style='font-size:24px'>新北市</option>
                    <option style='font-size:24px'>基隆市</option>
                    <option style='font-size:24px'>桃園市</option>
                    <option style='font-size:24px'>新竹縣</option>
                    <option style='font-size:24px'>其他</option>
                </select>
            </div> -->

            <!-- <div style='display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;'>
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://cdn2.ettoday.net/images/4724/d4724610.jpg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>小半樓 Art Space</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">700台南市中西區民權路一段199巷7號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">營業時間：週三-週六14:00~19:00(週日、一、二公休)</p>
                    <br>
                    <p style="font-size:20px;">電話：0982 816 009</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>
                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
                
            </div>
            <div style="display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;">
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://img.13shaniu.tw/uploads/20200511221842_72.jpeg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>龍泉冰店</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">721台南市麻豆區平等路2-4號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">營業時間：週一、週四-週日08:00~18:00(週二、三公休)</p>
                    <br>
                    <p style="font-size:20px;">電話：06 572 1796</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>
                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
            </div>
            <div style="display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;">
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://vickylife.com/wp-content/uploads/2023/09/台南鍋燒意麵︱閒情茗品屋：在樹蔭下享受鍋燒意麵真的好愜意啊！順便回味一下電視劇想見你的場景-12.jpg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>閒情茗品屋</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">702台南市南區金華路二段57巷97號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">營業時間：週一-週日06:30~18:00(週日到14:00)</p>
                    <br>
                    <p style="font-size:20px;">電話：06 265 1951</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>

                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
            </div>
            <div style="display:grid;grid-template-columns:2fr 5fr 1fr;grid-gap:30px;margin:auto auto auto 30px;padding-top:30px;width:100%;border-top:1px solid;">
                <div>
                    <img style="width: 250px !important;height:170px;border-radius: 20px;" src="https://imgs.gvm.com.tw/upload/gallery/20200414/72130_01.jpg">
                </div>
                <div>
                    <p style="font-size:24px;"><b>鳳和高中</b></p>
                    <div style="display: grid;grid-template-columns:1fr 4fr;width:100%;grid-gap:2px">
                    <p style="font-size:20px;"><b>地址</b></p>
                    <p style="font-size:20px;">736台南市柳營區中山東路二段1330號</p>
                    <p style="font-size:20px;"><b>景點資訊</b></p>
                    <p style="font-size:20px;">電話：0907 441 271</p>
                    <p style="font-size:20px;color:#1D50A1"><b>在此取景作品</b></p>
                    <p style="font-size:20px;color:#1D50A1"><b><a>想見你</a></b></p>

                    </div>
                    
                </div>
                <div style="position: relative;"><a style="font-size:20px;position:absolute;bottom:12px" href=""><i class="fa-regular fa-circle-info" style="color: #1d50a1;">&nbsp;&nbsp;詳細資訊</i></a></div>
                
            </div> -->

            
        </div>
    </section>
<!-- Product Section End -->

<?php include 'footer.html'; ?>



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
