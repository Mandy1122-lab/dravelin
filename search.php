<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php" ;
$conn = sql_open(); 
$sql = "SELECT 'a' AS source, a_name AS name, a_img AS img FROM a WHERE a_name LIKE '%$search%'
        UNION
        SELECT 'b' AS source, b_name AS name, b_img AS img FROM b WHERE b_name LIKE '%$search%'";
$search = $_POST["search"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>搜尋</title>
<!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #293158 
}
.container {
  max-width: 1200px;
  margin: 20px auto;
  padding: 0 20px;
}
.search-bar {
  margin-bottom: 20px;
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 20px; 
  width: 100%;
  box-sizing: border-box;
  font-size: 16px;
  background-color: #fff; 
  display: flex; 
  align-items: center;
}
.search-bar input[type="text"] {
  flex: 1;
  border: none;
  outline: none;
  padding: 6px 10px; 
  font-size: 16px;
}
.search-icon {
  color: #777; 
  margin-right: 10px; 
}
.search-icon:hover {
  color: #333; 
}
.grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 20px;
}
.card {
  background-color: #fff;
  padding: 5px;
  border-radius: 2px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  justify-content: center;
  align-items: center;
}
.card img {
  width: 100%;
  height: 200px; 
  object-fit: cover; 
  border-radius: 2px;
}
.card h3 {
  margin-top: 10px;
  font-size: 16px;
  text-align: center; 
  white-space: nowrap; 
  overflow: hidden;
  text-overflow: ellipsis; 
  max-width: 100%;

}
.back-icon {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 24px;
  color: #fff;
  cursor: pointer;
}
        
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
        .wrapper{
            display: grid;
            grid-template-columns: 1fr 2fr;
            margin-bottom: 15px;
        }

</style>
<header class="header">
  <div class="container">
      <div class="row"> 
          <div class="col-lg-2">
              <div class="heading_logo">
                  <a href="./index.html">

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
                                  <li><a href="#">C</a></li>
                                  <li><a href="#">A</a></li>
                                  <li><a href="#">A</a></li>
                                  <li><a href="#">B</a></li>
                              </ul>
                          </li>
                          <li><a href="#">電影<span class="arrow_carrot-down"></span></a>
                              <ul class="dropdown">
                                  <li><a href="#">C</a></li>
                                  <li><a href="#">A</a></li>
                                  <li><a href="#">A</a></li>
                                  <li><a href="#">a</a></li>
                              </ul>
                          </li>
                          <li><a href="#">拍攝景點<span class="arrow_carrot-down"></span></a>
                              <ul class="dropdown">
                                  <li><a href="#">台灣</a></li>
                                  <li><a href="#">韓國</a></li>
                                  <li><a href="#">日本</a></li>
                                  <li><a href="#">泰國</a></li>
                              </ul>
                          </li>
                          <li><a href="#">活動專區</a></li>
                      </ul>
                  </nav>
              </div>
          </div>
          
      </div>
      <div id="mobile-menu-wrap"></div>
  </div>
</header>
</head>
<body>
<a href="javascript:history.back()" class="back-icon"><i class="fas fa-arrow-left"></i></a>
<div class="container">
  <form method="POST" action="search.php" class="search-bar">
    <i class="fas fa-search search-icon"></i>
    <input type="text" name="search" placeholder="輸入關鍵字" required>
    <button type="submit" style="display: none;"></button>
  </form>
  <div class="grid">
    <?php
        $result = mysqli_query($conn, $sql);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<img src="' . $row["img"] . '">';
            echo '<h3>' . $row["name"] . '</h3>';
            echo '</div>';
        }
    } else {
        echo "查無結果";
    }
      $conn->close();
    ?>
  </div>
</div>
</body>
</html>
