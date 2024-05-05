<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open(); 
$sql = "SELECT * FROM genre";
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>分類</title>

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
            width: 100%;
            }

        td, th {
            border: 1px solid #B1B1B1;
            text-align: left;
            padding: 8px;
            text-align: center;
            }

        tr:nth-child(even) {
            background-color: #dddddd;
            }
        tr th,tr:nth-child(odd){
            background-color: #f5f5f5;
        }
        .my-btn{
            background-color: #F5F4F0;
            border-color: #1d50a1;
            color:#1d50a1;
            font-size: 18;
            font-weight: bold;
            margin-left: 1020px;
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
        .wrapper{
            display: grid;
            grid-template-columns: 1fr 2fr;
            margin-bottom: 15px;
        }

    </style>
</head>

<body class="font_set">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

        <?php
        include 'header-mng.html';
        ?>

    <section class="product-page spad">
        <div class="container">
            <div>
                <div class="section_title">
                    <h4>分類列表</h4>
                </div>

                <div class="wrapper">
                    <button type="button" class="btn btn-outline-primary my-btn">＋&nbsp;新增分類</button>
                </div>

                <?php
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>#</th><th>分類</th><th>操作</th></tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['g_id']}</td>";
                        echo "<td align='center' class='g-name'>{$row['g_name']}</td>";
                        echo "<td align='center'>
                                  <i class='fa-solid fa-pen edit-icon' style='color: #1d50a1; cursor: pointer; margin-left: 10px; font-size: 20px;'></i>
                                  <i class='fa-solid fa-trash delete-icon' style='color: #de2626; cursor: pointer; margin-left: 10px; font-size: 20px;'></i>
                                  <i class='fa-solid fa-check save-icon' style='display: none; color: #1d50a1; cursor: pointer; margin-left: 10px; font-size: 20px;'></i>
                              </td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                mysqli_close($conn);
                ?>

            </div>

        </div>
    </section>




    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/player.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        // 新增
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.my-btn').addEventListener('click', function () {
                var wrapper = document.querySelector('.wrapper');
                var row = document.createElement('div');
                row.classList.add('row');

                var nameInput = document.createElement('input');
                nameInput.setAttribute('type', 'text');
                nameInput.setAttribute('name', 'g_name');
                nameInput.setAttribute('placeholder', '輸入分類');
                nameInput.setAttribute('required', '');
                nameInput.classList.add('col');
                row.appendChild(nameInput);

                var saveIcon = document.createElement('i');
                saveIcon.classList.add('fa-solid', 'fa-check', 'save-icon');
                saveIcon.style.color = '#1d50a1';
                saveIcon.style.cursor = 'pointer';
                saveIcon.style.marginLeft = '25px'; 
                saveIcon.style.fontSize = '20px'; 
                saveIcon.addEventListener('click', function() {
                    var gName = nameInput.value;
                    if (gName.trim() !== '') {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'genre_manage.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                console.log('新增成功');
                                location.reload();
                            }
                        };
                        xhr.send('action=add&g_name=' + gName);
                    } else {
                        alert('分類名稱不能空白');
                    }
                });
                row.appendChild(saveIcon);

                wrapper.appendChild(row);
                document.querySelector('.my-btn').style.display = 'none';
            });

// 編輯
var editIcons = document.querySelectorAll('.edit-icon');
editIcons.forEach(function(icon) {
    icon.addEventListener('click', function() {
        var row = icon.parentNode.parentNode;
        var nameCell = row.querySelector('.g-name');
        var originalName = nameCell.textContent.trim();


        var nameInput = document.createElement('input');
        nameInput.setAttribute('type', 'text');
        nameInput.setAttribute('value', originalName);
        nameCell.textContent = '';
        nameCell.appendChild(nameInput);

        icon.classList.remove('fa-pen');
        icon.classList.add('fa-save');

        icon.addEventListener('click', function() {
            var newName = nameInput.value;
            var gId = row.getAttribute('data-id');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'genre_manage.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log('修改成功');
                    location.reload();
                }
            };
            xhr.send('g_id=' + gId + '&g_name=' + newName);
        });
    });
});


// 刪除
var deleteIcons = document.querySelectorAll('.delete-icon');
deleteIcons.forEach(function(icon) {
    icon.addEventListener('click', function() {
        if (confirm('是否確定刪除此分類？')) {
            var row = icon.parentNode.parentNode;
            var gId = row.getAttribute('data-id');
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'genre_manage.php?action=delete&g_id=' + gId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log('刪除成功');
                    location.reload();
                }
            };
            xhr.send();
        }
    });
});

        });
    </script>

</body>

</html>
