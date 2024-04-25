<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/lib_mysql.php";

$conn = sql_open(); 

    // 新增
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['g_name'])) {

    $g_name = $_POST['g_name'];
    $sql = "INSERT INTO genre (g_name) VALUES ('$g_name')";
    mysqli_query($conn, $sql);
}

    // 修改
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['g_id']) && isset($_POST['g_name'])) {

    $g_id = $_POST['g_id'];
    $g_name = $_POST['g_name'];
    $sql = "UPDATE genre SET g_name='$g_name' WHERE g_id='$g_id'";
    mysqli_query($conn, $sql);
}

    // 刪除
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['g_id'])) {

    $g_id = $_GET['g_id'];
    $sql = "DELETE FROM genre WHERE g_id='$g_id'";
    mysqli_query($conn, $sql);

    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}


$sql = "SELECT * FROM genre";
$result = mysqli_query($conn, $sql);

?>

<form method="post" action="">
    <input type="text" name="g_name" placeholder="輸入分類" required>
    <button type="submit">新增分類</button>
</form>

<?php
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>#</th><th>分類</th><th>操作</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['g_id']}</td>";
        echo "<td align='center'><input type='text' id='g_name_{$row['g_id']}' value='{$row['g_name']}'></td>";
        echo "<td align='center'><button onclick='saveGenre({$row['g_id']})'>儲存</button></td>";
        echo "</tr>";
    }

    echo "</table>";
}

mysqli_close($conn);
?>

<script>
function saveGenre(g_id) {
    var g_name = document.getElementById('g_name_' + g_id).value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'genre-management.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Updated successfully');
        }
    };
    xhr.send('g_id=' + g_id + '&g_name=' + g_name);
}
</script>
