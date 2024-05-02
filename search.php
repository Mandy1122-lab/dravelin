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
<!--font-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
<script src="https://kit.fontawesome.com/937e93c93c.js" crossorigin="anonymous"></script>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0 0 0 0;
  padding-top: 20px;
  background-color: #293158; 
}
.container {
  margin-top: 50px;
  max-width: 1200px;
  margin:  auto;
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
  grid-gap: 75px;
}
.card {
  background-color: #fff;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  justify-content: center;
  align-items: center;
}
.card img {
  width: 220px;
  height: 320px;
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
  top: 32px;
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
</head>
<body>
<a href="javascript:history.back()" class="back-icon"><i class="fas fa-arrow-left"></i></a>
<div class="container">
    <form method="POST" action="search.php" class="search-bar">
        <i class="fas fa-search search-icon"></i>
        <input type="text" name="search" placeholder="輸入關鍵字" required>
        <button type="submit" style="display: none;"></button>
    </form>

    <?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";

if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $conn = sql_open();

    $sql = "SELECT 'drama' AS source, d_id AS id, d_name AS name, d_pic AS img FROM drama WHERE d_name LIKE '%$search%'
            UNION
            SELECT 'movie' AS source, m_id AS id, m_name AS name, m_pic AS img FROM movie WHERE m_name LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo '<div class="grid">';
        while($row = $result->fetch_assoc()) {
            echo '<a href="' . $row["source"] . '.php?id=' . $row["id"] . '">';
            echo '<div class="card">';
            echo '<img src="' . $row["img"] . '">';
            echo '<h3>' . $row["name"] . '</h3>';
            echo '</div></a>';
        }
        echo '</div>';
    } else {
        echo "查無結果";
    }

    $conn->close();
}
?>

</div>
</body>
</html>
