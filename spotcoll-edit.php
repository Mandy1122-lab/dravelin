<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯、刪除 - 景點合輯</title>

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
            width: 90%;
            /* border-radius: 50% !important;  */

            }

        td, th {
            border: 1px solid #1d50a1;
            padding: 8px;
            text-align: center;
            background-color: #f5f4f0;
            
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
        .search{
            max-width: 220px;
            background-color: #D9D9D9;
            border-color: #1d50a1;
            font-family: Inter;

            margin-top: 25px;
        }

    .cancel{
            background-color: #abbad5;
            border-color: #abbad5;
            color:black !important;
            font-weight: bold;
            margin-left: 67%;
            margin-top: 60px;
        }
        .cancel:hover,
        .cancel:active{
            background-color: #F5F4F0!important;
            border-color: #abbad5!important;
            color:#abbad5 !important; 
        }

        .save{
            background-color: #FED566;
            border-color: #FED566;
            color:black !important;
            font-weight: bold;
            margin-left: 10px;
            margin-top: 60px;
        }
        .save:hover,
        .save:active{
            background-color: #F5F4F0!important;
            border-color: #FED566!important;
            color:#FED566 !important; 
        }
        .input{
            border-color: #1d50a1;
            background-color: #F5F4F0;
            width:500px !important;

        }

        .delete{
            background-color: #f5f4f0;
            border-color: #EA5A47;
            color:#EA5A47 !important;
            font-weight: bold;
        }
        .delete:hover,
        .delete:active{
            background-color: #EA5A47!important;
            border-color: #EA5A47!important;
            color:#f5f4f0 !important; 
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
    <!--帶入資料-->
    <?php 
    if (isset($_GET["sc_id"])){
        include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
        $conn = sql_open();
        $sc_id = $_GET["sc_id"];

        $sql = "SELECT * FROM scomplication WHERE sc_id ='$sc_id'";
        $result = mysqli_query($conn,$sql);
        if ($row = mysqli_fetch_assoc($result)){
        $existingData = [
            'sc_name' => $row['sc_name'],
            'sc_pic' => $row['sc_pic'],
            'sc_intro' => $row['sc_intro']

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
        $sc_id = $_POST["sc_id"];
        $sc_name = $_POST["sc_name"];
        $sc_pic = $_POST["sc_pic"];
        $sc_intro = $_POST["sc_intro"];

        $sql = "UPDATE scomplication SET sc_name = '$sc_name', sc_pic = '$sc_pic' , sc_intro = '$sc_intro' WHERE sc_id='$sc_id' ";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            echo '<script>window.location.href = "spot-complication.php";</script>';
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        
    }
    ?>



    <!-- Product Section Begin -->
    <section class="product-page spad" style="margin-top: -30px !important;">
        <div class="container">
            <div>
                <!--標題-->
                <div class="section_title">
                    <nobr>
                    <h4 style="display: inline-block !important;">編輯、刪除 - 景點合輯</h4>
                    
                    </nobr>
                </div>
                <!--切割版面-->
                
                <form action="spotcoll-edit.php" method="post">
                <input type="hidden" name="sc_id" value="<?php echo $sc_id; ?>">
                <div style="display:grid;grid-template-columns:1fr 1fr">
                    <!--左半（搜尋結果）-->
                    <div>
                    <label for="inputEmail4">合輯名稱</label>
                    <input type="text" class="form-control input" placeholder="請輸入名稱" name="sc_name" value="<?php echo $existingData['sc_name'];?>">
                    <label for="inputEmail4" style="margin-top: 25px;" >合輯封面圖</label>
                    <input type="text" class="form-control input" placeholder="請輸入位置" name="sc_pic" value="<?php echo $existingData['sc_pic'];?>">
                    <label for="inputEmail4" style="margin-top: 25px;">合輯簡介</label>
                    <textarea class="form-control input" placeholder="請輸入內容" rows="5" style="height: 150px;" name="sc_intro" value="<?php echo $existingData['sc_intro'];?>"></textarea>
                    </div>
                    <!--右半（目前列表）-->
                    <div style="padding-top:270px">
                        <nobr>
                        <button type="reset" onclick="window.location.href='spot-complication.php'" class="btn btn-outline-primary cancel" >取消</button>
                        
                        <button type="submit" name="Update" class="btn btn-outline-primary save" >儲存</button>
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
