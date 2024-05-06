<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
//建立資料庫連線
$conn = sql_open();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯 - 小專區1</title>
    <style>
        body {
            background-color: #F5F4F0;
        }
    </style>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/content-wrapper.css" type="text/css">

    <!-- Js Plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header>
    <?php
        include 'header-mng.html';
    ?>
    </header>
    <!-- Header End -->

    <!-- Content section, adding the dropdown menu and input fields -->
    <section id="content" style="display: flex; flex-direction: column; margin: 0 auto; max-width: 1000px; margin-top: 20px; margin-left: 200px ">
        <style>
            h5 .bold-text {
                font-weight: bold;
                /* 將class為bold-text的文本設置為粗體 */
            }

            hr {
                border: none;
                /* 移除預設邊框 */
                border-top: 1px solid black;
                /* 設置頂部邊框為3px的黑色實線 */
                margin: 50px 0 10px 0;
                /* 設置上下邊距 */
                width: 90%;
            }

            h6.text-size {
                font-size: 13px;
                /* 將<h6>元素中的文本設置為13像素 */
                margin-bottom: 5px;
            }
        </style>

        <h5><span class=bold-text>編輯 - 小專區1</span></h5>
        <hr>
        <!-- Input Fields -->
        <script>
            $(document).ready(function() {
                $('#updateArea').submit(function(e) {
                    e.preventDefault(); // 阻止表單的默認提交行為
                    $.ajax({
                        type: "POST",
                        url: "dblink-area.php", // 提交到當前頁面或指定處理腳本的 URL
                        data: $(this).serialize(), // 序列化表單數據
                        success: function(response) {
                            alert("更新成功"); // 使用 alert 顯示服務器的回應
                        },
                        error: function() {
                            alert("更新失敗"); // 在更新失敗時顯示警告
                        }
                    });
                });
            });
        </script>
        <?php
        $link = mysqli_connect('localhost', 'root', 'fjuim110', 'dravelin');
        $result = mysqli_query($link, "SELECT * FROM area WHERE area_id = 1"); // 根據“小專區1”的ID查詢記錄
        $row = mysqli_fetch_assoc($result);
        ?>
        <form id="updateArea">
            <div style="display: flex; align-items: flex-start; margin-top: 20px;">
                <div style="flex: 1; margin-top: 0; width: 500px;">
                    <h6 class="text-size">專區標題</h6>
                    <input type="text" name="area_name" placeholder="標題名稱" value="<?php echo htmlspecialchars($row['area_name']); ?>" style="border: 1px solid #1D50A1; width:70%; height:35px; background-color:#F5F4F0;">
                </div>

                <div style="flex: 1;margin-top: 0; width: 500px;">
                    <h6 class="text-size">封面圖片</h6>
                    <input type="text" name="area_pic" placeholder="圖片網址" value="<?php echo htmlspecialchars($row['area_pic']); ?>" style="border: 1px solid #1D50A1; width:70%; height:35px; background-color:#F5F4F0;">
                </div>
            </div>

            <!-- Dropdown Menu -->
            <div style="margin-top: 20px;">
                <h6 class="text-size">選擇類別</h6>
                <select name="area_choose">
                    <?php
                    // 合併查詢，並加上來源標籤
                    $query = "(SELECT l_id, l_name, 'drama' AS type FROM listdrama) UNION (SELECT l_id, l_name, 'movie' AS type FROM listmovie)";
                    $listResult = mysqli_query($link, $query);
                    while ($list = mysqli_fetch_assoc($listResult)) {
                        $value = $list['type'] . '-list.php?l_id=' . $list['l_id'];
                        $selected = ($value == $row['area_choose']) ? ' selected' : '';
                        echo '<option value="' . $value . '"' . $selected . '>' . htmlspecialchars($list['l_name']) . ' (' . ucfirst($list['type']) . ')</option>';
                    }
                    ?>
                </select>

            </div>

            <!-- Hidden Field for Action -->
            <input type="hidden" name="action" value="save_changes">
            <!-- Hidden Field for Playlist ID -->
            <input type="hidden" name="area_id" value="1"> <!-- 這裡將其設置為1表示“小專區1” -->

            <!-- Buttons -->
            <div style="margin-top: 70px; align-self: flex-end; margin-bottom: 20px; display: flex; justify-content: flex-end;">
                <button type="reset" style="margin-right: 10px; background-color:#1D50A1; background:rgba(29, 80, 161, 0.5); color:black; font-size: 10px; font-weight: bold; border: none; padding: 6px 15px; border-radius: 3px;">取消</button>
                <button type="submit" style="margin-right: 120px; background-color: #FED566; color:black; font-size: 10px; font-weight: bold; border: none; padding: 6px 15px; border-radius: 3px;">儲存</button>
            </div>
        </form>
    </section>
    <!-- End of content section -->

    <!-- Footer Section Begin -->
    
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <!-- Search Close Btn -->
        <div class="search-close-switch"><span class="icon_close"></span></div>
        <div class="search-mg">
            <!-- Search Input -->
            <input type="text" class="search-input" placeholder="Search here.....">
            <!-- Search Button -->
            <button type="submit" class="search-btn"><span class="icon_search"></span></button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>