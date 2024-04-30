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
    <!--原有資料-->
    <?php 
    if (isset($_GET["s_id"])){
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();
        $s_id = $_GET["s_id"];

        $sql = "SELECT * FROM spot WHERE s_id ='$s_id'";
        $result = mysqli_query($conn,$sql);
        if ($row = mysqli_fetch_assoc($result)){
        $existingData = [
            's_name' => $row['s_name'],
            's_add' => $row['s_add'],
            's_info' => $row['s_info'],
            's_intro' => $row['s_intro'],
            's_photo' => $row['s_photo'],
            's_pic' => $row['s_pic'],

        ];
        }else{
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
        $s_intro = $_POST["s_intro"];
        $s_info = $_POST["s_info"];
        $s_photo = $_POST["s_photo"];
        $s_pic = $_POST["s_pic"];

        $sql = "UPDATE spot SET s_name = '$s_name', s_add = '$s_add', s_intro = '$s_intro', s_info = '$s_info', s_photo = '$s_photo', s_pic = '$s_pic' WHERE s_id='$s_id' ";

        if (mysqli_query($conn, $sql)) {
            echo "編輯成功";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        echo '<script>window.location.href = "spot-manage.php";</script>';
        exit(); 
    }
    ?>

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div>
                <div class="section_title line">
                    <h4 class="s-edit-del">編輯 - 景點介紹</h4>
                    <button type="button" class="btn btn-outline-primary delete" onclick="window.location.href='spot-del.php?s_id=<?php echo $row['s_id']; ?>'">刪除景點</button>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
                    <div class="row">
                    <div class="col">
                        <label for="inputEmail4">景點名稱</label>
                        <input type="text" name="s_name" class="form-control" placeholder="請輸入名稱" value="<?php echo $existingData['s_name'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">地址</label>
                        <input type="text" name="s_add" class="form-control" placeholder="請輸入地址" value="<?php echo $existingData['s_add'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點地圖（Google Map）</label>
                        <input type="text" class="form-control" placeholder="請輸入網址">

                        <label for="inputEmail4" style="margin-top: 25px;">景點資訊</label>
                        <input type="text" name="s_info" class="form-control" placeholder="請輸入營業時間、電話等資訊" value="<?php echo $existingData['s_info'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">在此取景作品</label><br>
                        <select class="form-control select" id="exampleFormControlSelect1" >
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                        
                    </div>
                    <div class="col">
                        <label for="inputEmail4">景點簡介</label>
                        <textarea class="form-control" name="s_intro" placeholder="請輸入內容" rows="5"><?php echo $existingData['s_intro']; ?></textarea>


                        <label for="inputEmail4" style="margin-top: 25px;">相關劇照</label>
                        <input type="text" name="s_photo" class="form-control" placeholder="請輸入位置" value="<?php echo $existingData['s_photo'];?>">

                        <label for="inputEmail4" style="margin-top: 25px;">景點封面圖</label>
                        <input type="text" name="s_pic" class="form-control" placeholder="請輸入位置" value="<?php echo $existingData['s_pic'];?>">
                        <nobr>
                        <button type="reset" class="btn btn-outline-primary cancel" >取消</button>
                        <button type="submit" name="Update" onclick="return confirmaction()" class="btn btn-outline-primary save">儲存</button>
                        </nobr>

                    </div> 
                    
                    </div>
                </form>
    
                
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
<script src="confirmsave.js"></script>

</body>

</html>
