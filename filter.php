<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";
$conn = sql_open(); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['genre'])) {
    $genre = $_GET['genre'];
    $genre_filter = "AND g_id = $genre";
} else {
    $genre_filter = '';
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT 'drama' AS source, d_id AS id, d_name AS name, d_pic AS img FROM drama WHERE d_name LIKE '%$search%' $genre_filter
        UNION
        SELECT 'movie' AS source, m_id AS id, m_name AS name, m_pic AS img FROM movie WHERE m_name LIKE '%$search%' $genre_filter";


if(isset($_GET['type'])) {
    $type = $_GET['type'];
    if($type == 'drama') {
        $type_filter = "d_id";
        $source_filter = "drama";
    } elseif($type == 'movie') {
        $type_filter = "m_id";
        $source_filter = "movie";
    } else {
        $type_filter = "d_id OR type = 'm_id'";
        $source_filter = "drama OR source = 'movie'";
    }
} else {
    $type_filter = '';
}


if($search !== '' || isset($_GET['genre']) || isset($_GET['type'])) {
    $result = mysqli_query($conn, $sql);
} else {
    $result = false;
}

?>

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
    margin: 0;
    padding-top: 20px;
    background-color: #293158;
}

.container {
    margin-top: 50px;
    max-width: 1200px;
    margin: auto;
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
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    justify-content: center;
    align-items: center;
}

.card img {
    width: 220px;
    height: auto;
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

.heading_logo,
.heading_logo a {
    color: white;
    font-weight: bold;
    font-size: 30px;
    margin-top: 7px;
}

.section_title {
    margin-bottom: 30px;
    color: #000;
    font-weight: 600;
    line-height: 21px;
    text-transform: uppercase;
    padding-left: 20px;
    position: relative;
}

.section_title,
.section_title h4 {
    margin-bottom: 30px;
    color: #000;
    font-weight: bolder;
    line-height: 21px;
    text-transform: uppercase;
    padding-left: 15px;
    position: relative;
}

.section_title {
    border-bottom: 1px solid;
}

table {
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #b1b1b1;
    text-align: left;
    padding: 8px;
    text-align: center;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

tr th,
tr:nth-child(odd) {
    background-color: #f5f5f5;
}

.my-btn {
    background-color: #f5f4f0;
    border-color: #1d50a1;
    color: #1d50a1;
    font-size: 18px;
    font-weight: bold;
    margin-left: 1020px;
    width: 120px;
}

.my-btn:hover {
    background-color: #1d50a1;
    border-color: #1d50a1;
    color: #f5f4f0;
}

.my-btn:active {
    background-color: #1d50a1;
    border-color: #1d50a1;
    color: #f5f4f0;
}

.wrapper {
    display: grid;
    grid-template-columns: 1fr 2fr;
    margin-bottom: 15px;
}

.wrapper h4 {
    margin-bottom: 10px;
    padding-bottom: 5px;
    color: white;
}

.options label {
    padding: 5px 15px;
    border: 1px solid #ccc;
    border-radius: 20px;
    cursor: pointer;
    color: white;
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 10px;
}

.options label:hover {
    background-color: #f5f5f5;
}

.options input[type="checkbox"] {
    display: none;
}

.options input[type="checkbox"]:checked+label {
    background-color: #1d50a1;
    color: #293158;
    border: 1px solid #1d50a1;
}


.title {
    text-align: center;
    color: white;
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
                <button type="submit" class="btn btn-outline-primary my-btn">查詢</button>
            </div>
        </form>

        <div id="searchResults" class="grid">
            <?php

            if($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="grid">';
                while($row = $result->fetch_assoc()) {
                echo '<a href="' . $row["source"] . '-detail.php?id=' . $row["id"] . '">';
                echo '<div class="card">';
                echo '<img src="' . $row["img"] . '">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '</div></a>';
                    }
                echo '</div>';
                }
            } elseif(!$result && $search !== '') {
                echo "<div class='card'>
                        <h3>沒有搜尋結果</h3>
                    </div>";
            } else {
                echo "<div class='card'>
                        <h3>請輸入搜尋條件</h3>
                    </div>";
            }
            ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        fetchOptions('genreOptions', 'SELECT g_id, g_name FROM genre');

        document.getElementById("searchForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const selectedGenre = document.querySelector('input[name="genre"]:checked').value;

            const selectedType = document.querySelector('input[name="type"]:checked').value;

            fetchSearchResults(selectedGenre, selectedType);
        });
    });

    function fetchOptions(elementId, sql) {
        fetch('fetch_options.php?sql=' + encodeURIComponent(sql))
            .then(response => response.json())
            .then(data => {
                let optionsHtml = '';
                data.forEach(option => {
                    optionsHtml += `<label><input type="checkbox" name="genre" value="${option.g_id}"> ${option.g_name}</label>`;
                });
                document.getElementById(elementId).innerHTML = optionsHtml;
            });
    }

    function fetchSearchResults(selectedGenre, selectedType) {
        let searchResultsContainer = document.getElementById("searchResults");
        searchResultsContainer.innerHTML = "搜尋中...";

        fetch('fetch_results.php?genre=' + encodeURIComponent(selectedGenre) + '&type=' + encodeURIComponent(selectedType))
            .then(response => response.json())
            .then(data => {
                let resultsHtml = '';
                data.forEach(result => {
                    resultsHtml += `<div class="card">
                                        <img src="${result.img}" alt="${result.name}">
                                        <h3>${result.name}</h3>
                                    </div>`;
                });
                searchResultsContainer.innerHTML = resultsHtml;
            });
    }
    </script>
</body>
</html>
