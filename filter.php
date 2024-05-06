<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$genre = $_GET['genre'] ?? '';
$type = $_GET['type'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['genre'])) {
    $genre = mysqli_real_escape_string($conn, $_GET['genre']);
    $type = mysqli_real_escape_string($conn, $_GET['type'] ?? '');

    $sql = "SELECT 'drama' AS source, d.d_id AS id, d.d_name AS name, d.d_pic AS img
            FROM drama d
            INNER JOIN genred gd ON d.d_id = gd.d_id
            INNER JOIN genre g ON gd.g_id = g.g_id
            WHERE g.g_id = '$genre'";

    if ($type !== '') {
        $sql .= " AND 'drama' = '$type'";
    }

    $sql .= " UNION
              SELECT 'movie' AS source, m.m_id AS id, m.m_name AS name, m.m_pic AS img
              FROM movie m
              INNER JOIN genrem gm ON m.m_id = gm.m_id
              INNER JOIN genre g ON gm.g_id = g.g_id
              WHERE g.g_id = '$genre'";

    if ($type !== '') {
        $sql .= " AND 'movie' = '$type'";
    }

    $result = mysqli_query($conn, $sql);
}
?>

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>進階搜尋</title>

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
  align: center;
  display: block;
  margin: 0 auto; 
}
.card h3 {
  margin-top: 10px;
  font-size: 16px;
  text-align: center;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis; 
  max-width: 100%;
  color: black;
  text-decoration: none;

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
            margin-left: 1020px;
            width: 120px;

        }
        .my-btn:hover{
            background-color: #1d50a1;
            border-color: #1d50a1;
            color: #f5f4f0;
        }
        .my-btn:active{
            background-color: #1d50a1 ;
            border-color: #1d50a1 ;
            color: #f5f4f0 ;
        }
        .wrapper{
            display: grid;
            grid-template-columns: 1fr 2fr;
            margin-bottom: 15px;
        }


        .wrapper {
    margin-bottom: 20px;
    display: flex; 
    flex-wrap: wrap;
}

.wrapper > div {
    margin-right: 20px; 
    margin-bottom: 20px;
}


    .wrapper h4 {
        margin-bottom: 10px;
        padding-bottom: 5px;
        color: white;
    }
    .options {
    display: flex; 
    flex-wrap: wrap; 
    justify-content: flex-start; 
}

.options label {
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 20px;
    cursor: pointer;
    color: white;
    margin-right: 5px;
}


    .options label:hover {
        background-color: #f5f5f5;
    }

    .options input[type="checkbox"] {
        display: none;
    }

    .options input[type="checkbox"]:checked+label {
        background-color:#fed566;
        color: #fed566;
        border: 1px solid white;
    }
    .options label.selected {
    background-color: #fed566;
    color: #1d50a1;
    border: 1px solid white;
}

    .title {
        color: white;
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
    }
    </style>
</head>
<body>
    <div class="title">進階搜尋</div>

    <div class="container">
        <form id="searchForm" method="GET" action="">
            <div class="wrapper">
                <div>
                    <h4>作品類型</h4>
                    <div class="options" id="typeOptions">
                        <label><input type="checkbox" name="type" value="drama"> 劇集</label>
                        <label><input type="checkbox" name="type" value="movie"> 電影</label>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div>
                    <h4>作品類別</h4>
                    <div class="options" id="genreOptions">
                        <?php
                        $sql_genre = "SELECT * FROM genre";
                        $result_genre = mysqli_query($conn, $sql_genre);
                        while($row_genre = mysqli_fetch_assoc($result_genre)) {
                            echo "<label><input type='checkbox' name='genre' value='".$row_genre['g_id']."'>".$row_genre['g_name']."</label>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="wrapper">
                <button type="button" id="searchButton" class="btn btn-outline-primary my-btn">查詢</button>
            </div>
        </form>

        <div id="searchResults" class="grid">
            <?php
            if($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $id_param = $row["source"] == "drama" ? "d_id" : "m_id";
                    echo '<a href="' . $row["source"] . '-detail.php?' . $id_param . '=' . $row["id"] . '">';
                    echo '<div class="card">';
                    echo '<img src="' . $row["img"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '</div></a>';
                }
            } else {
                echo "<div class='card'>
                <h3 style='color: white; font-size: 20px; font-weight: bold;'>沒有搜尋結果</h3>
                    </div>";
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("searchButton").addEventListener("click", function(event) {
        const selectedGenres = Array.from(document.querySelectorAll('input[name="genre"]:checked')).map(el => el.value);
        const selectedType = document.querySelector('input[name="type"]:checked').value;

        fetchSearchResults(selectedGenres, selectedType);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const genreOptions = document.querySelectorAll('#genreOptions input[type="checkbox"]');

    genreOptions.forEach(option => {
        option.addEventListener('click', function() {
            if (this.checked) {
                this.parentNode.classList.add('selected');
            } else {
                this.parentNode.classList.remove('selected');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const typeOptions = document.querySelectorAll('#typeOptions input[type="checkbox"]');

    typeOptions.forEach(option => {
        option.addEventListener('click', function() {
            if (this.checked) {
                this.parentNode.classList.add('selected');
            } else {
                this.parentNode.classList.remove('selected');
            }
        });
    });
});


function fetchSearchResults(selectedGenres, selectedType) {
    let searchResultsContainer = document.getElementById("searchResults");
    searchResultsContainer.innerHTML = "<div class='card'><h3 style='color: white; font-size: 20px; font-weight: bold;'>搜尋中...</h3></div>";

    fetch('fetch_result.php?genre=' + encodeURIComponent(selectedGenres.join(',')) + '&type=' + encodeURIComponent(selectedType))
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                let resultsHtml = '';
                data.forEach(result => {
                    resultsHtml += `<a href="${result.source}-detail.php?id=${result.id}">
                        <div class="card">
                            <img src="${result.img}">
                            <h3>${result.name}</h3>
                        </div>
                    </a>`;
                });

                searchResultsContainer.innerHTML = resultsHtml;
            } else {
                searchResultsContainer.innerHTML = "<div class='card'><h3 style='color: white; font-size: 20px; font-weight: bold;'>沒有搜尋結果</h3></div>";
            }
        })
        .catch(error => {
            console.error('Error fetching search results:', error);
            searchResultsContainer.innerHTML = "<div class='card'><h3 style='color: white; font-size: 20px; font-weight: bold;'>搜尋錯誤</h3></div>";
        });
}

    </script>
</body>
</html>
