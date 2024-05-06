<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯 - 輪播頁</title>
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
    <script src="https://kit.fontawesome.com/937e93c93c.js" crossorigin="anonymous"></script>
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

    <!-- Content section,Blog Details Section Begin -->
    <style>
        .blog-details {
            margin-top: 0;
            /* 將上邊距設置為0 */
            padding-top: 0;
            /* 將上內邊距設置為0 */
        }

        h5 .bold-text {
            font-weight: bold;
            /* 將class為bold-text的文本設置為粗體 */
        }

        .blog__details__form {
            max-width: 1200px;
            /* 設置最大寬度 */
            margin: 0 auto;
            /* 讓元素在容器中水平居中 */
            padding: 0 130px;
            /* 添加左右邊距 */
        }

        .nav {
            margin-top: 20px;
        }

        .nav-tabs {
            border-bottom: 1px solid #000;
            /* 將下邊框設置為1像素寬度的黑色 */
        }

        /* 將分頁項目樣式應用到.nav-tabs的.nav-link上 */
        .nav-tabs .nav-link {
            border: none;
            /* 移除預設的邊框 */
            border-radius: 0;
            /* 移除圓角 */
            background-color: #F5F4F0;
            /* 移除背景色 */
            color: #000;
            /* 設置文字顏色 */
            font-size: 13px;
            /* 調整分頁中文字的大小 */
            font-weight: normal;
            /* 設置分頁中文字為粗體 */
            padding: 10px 15px 5px 15px;
            /* 設置填充 */
            cursor: pointer;
            /* 添加指示游標 */
        }

        /* 活動分頁項目的樣式 */
        .nav-tabs .nav-link.active {
            background-color: #D9D9D9;
            /* 設置懸停時的背景色 */
            color: #000;
            /* 設置懸停時的文字顏色 */
            border-bottom: none;
            /* 移除懸停時的下框線 */
        }

        /* 將:hover樣式應用到分頁項目上，當鼠標懸停在項目上時 */
        .nav-tabs .nav-link:hover {
            background-color: #E0E0E0;
            /* 設置懸停時的背景色 */
            color: #000;
            /* 設置懸停時的文字顏色 */
            border-bottom: none;
            /* 移除懸停時的下框線 */
        }

        h6.text-size {
            font-size: 13px;
            /* 將<h6>元素中的文本設置為13像素 */
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .custom-table {
            /* 在這裡添加自定義樣式 */
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f8f8;
        }
    </style>
    <section class="blog-details spad" style="display: flex; flex-direction: column; margin: 0 auto; max-width: 1200px; margin-top: 20px;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="blog__details__form">
                        <h5><span class=bold-text>編輯 - 輪播頁</span></h5>
                        <script>
                            function switchPage(pageNumber) {
                                // 在加載數據之前，獲取按鈕容器並隱藏它
                                var buttonContainer = document.querySelector('.button-container');
                                buttonContainer.classList.add('hidden');

                                // 修改活動分頁的類別
                                document.querySelectorAll('.nav-link').forEach(link => {
                                    link.classList.remove('active');
                                });
                                document.getElementById('tab-' + pageNumber).classList.add('active');

                                // 使用 AJAX 技術向後端發送請求以獲取相應分頁的資料並更新用戶介面
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        // 更新用戶介面
                                        document.getElementById("page-content").innerHTML = this.responseText;
                                        // 設置隱藏欄位的值
                                        document.querySelector('input[name="page"]').value = pageNumber;
                                        // 在數據加載完成後顯示按鈕
                                        buttonContainer.classList.remove('hidden');
                                    }
                                };
                                xhttp.open("GET", "carousel-loadnav.php?page=" + pageNumber, true);
                                xhttp.send();
                            }
                        </script>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#first" type="button" role="tab" aria-controls="first" aria-selected="true" onclick="switchPage(1)">第一頁</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#second" type="button" role="tab" aria-controls="second" aria-selected="false" onclick="switchPage(2)">第二頁</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#third" type="button" role="tab" aria-controls="third" aria-selected="false" onclick="switchPage(3)">第三頁</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#forth" type="button" role="tab" aria-controls="frth" aria-selected="false" onclick="switchPage(4)">第四頁</button>
                            </li>
                        </ul>
                        <style>
                            .hidden {
                                display: none;
                            }
                        </style>
                        <script>
                            $(document).ready(function() {
                                $('#carouselContent').submit(function(e) {
                                    e.preventDefault(); // 阻止表單的默認提交行為
                                    $.ajax({
                                        type: "POST",
                                        url: "carousel-update.php", // 提交到當前頁面或指定處理腳本的 URL
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
                        <form id="carouselContent">
                            <div class="tab-content" id="page-content">
                                <!-- 這裡將顯示動態生成的分頁內容 -->
                            </div>
                            <!-- Buttons -->
                            <div class="button-container hidden" style="margin-top: 0px; align-self: flex-end; margin-bottom: 20px; display: flex; justify-content: flex-end;">
                                <button type="reset" style="margin-right: 10px; background-color:#1D50A1; background:rgba(29, 80, 161, 0.5); color:black; font-size: 10px; font-weight: bold; border: none; padding: 6px 15px; border-radius: 3px;">取消</button>
                                <button type="submit" style="margin-right: 300px; background-color: #FED566; color:black; font-size: 10px; font-weight: bold; border: none; padding: 6px 15px; border-radius: 3px;">儲存</button>
                            </div>
                        </form>
                        <script>
                            function resetForm() {
                                // 重置表單到初始狀態
                                document.getElementById('dataForm').reset();
                                // 你也可以加載初始數據，如果有必要的話
                                switchPage(1); // 假設初始狀態在第一頁
                            }
                        </script>
                        <div style="flex: 1; margin-top: 10px;">
                            <h6 class="text-size">選擇連結之&nbsp;
                                <input type='radio' name='category' value='drama' style="vertical-align: middle;">&nbsp;劇集(drama-detail.php?d_id=) /
                                <input type='radio' name='category' value='movie' style="vertical-align: middle;">&nbsp;電影(movie-detail.php?m_id=) /
                                <input type='radio' name='category' value='event' style="vertical-align: middle;">&nbsp;活動(event-details.php?id=)
                            </h6>
                            <form id="searchForm" class="header__search__form">
                                <input type="text" name="search" placeholder="搜尋作品/活動" style="border: 1px solid #1D50A1; width:150px; height:30px;background-color: #E0E0E0;">
                                <button type="submit" style="border: 1px solid #1D50A1; width:30px; height:30px; background-color: #E0E0E0;"><span class="icon_search"></span></button>
                                <div id="searchResults"></div>
                            </form>
                        </div>
                        <div id="searchResults">
                            <table data-toolbar="#toolbar" class="table bg-light table-striped" data-toggle="table" data-sortable="true" data-sort-class="table-active" data-pagination="true" data-search="true">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true" style="width:10%;">#</th>
                                        <th data-field="number" data-sortable="true" style="width:20%;">作品/活動編號</th>
                                        <th data-field="name" data-sortable="true" style="width:38%;">作品/活動名稱</th>
                                        <th data-field="link" data-sortable="true" style="width:30%;">作品/活動連結</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('input[name="category"]').forEach(function(radio) {
                                    radio.addEventListener('change', function() {
                                        var selectedCategory = this.value;
                                        loadData(selectedCategory);
                                    });
                                });
                            });

                            function loadData(selectedCategory) {
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            document.getElementById('tableBody').innerHTML = xhr.responseText;
                                        } else {
                                            console.error('請求出錯：' + xhr.status);
                                        }
                                    }
                                };
                                xhr.open('POST', 'carousel-loadtable.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.send('category=' + selectedCategory);
                            }
                        </script>
                        <script>
                            document.getElementById('searchForm').addEventListener('submit', function(event) {
                                event.preventDefault(); // 阻止提交表單的默認行為

                                var keyword = document.querySelector('input[name="search"]').value;
                                var selectedCategory = document.querySelector('input[name="category"]:checked').value;
                                var tableRows = document.querySelectorAll('#tableBody tr'); // 獲取表格中的所有行

                                tableRows.forEach(function(row) {
                                    var rowData = row.innerText.toLowerCase(); // 將行中的文本轉換為小寫
                                    if (rowData.includes(keyword.toLowerCase())) { // 如果行中包含搜索關鍵字
                                        row.style.display = ''; // 顯示行
                                    } else {
                                        row.style.display = 'none'; // 隱藏行
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content section, Blog Details Section End -->

    <!-- Footer Section Begin -->

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="js/player.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>