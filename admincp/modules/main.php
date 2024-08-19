<div class="clear"></div>
<div class="main">
<?php
// Bắt đầu phần xử lý logic dựa trên các tham số trong URL
if (isset($_GET['action']) && isset($_GET['query'])) {
    $tam = $_GET['action'];
    $query = $_GET['query'];
} else {
    $tam = '';
    $query = '';
}

// Xử lý điều kiện theo giá trị của action và query
if ($tam == 'quanlydanhmucsanpham' && $query == 'them') {
    include("modules/quanlydanhmucsp/them.php");
    include("modules/quanlydanhmucsp/lietke.php");
} elseif ($tam == 'quanlydanhmucsanpham' && $query == 'sua') {
    include("modules/quanlydanhmucsp/sua.php");
} elseif ($tam == 'quanlysp' && $query == 'them') {
    include("modules/quanlysp/them.php");
    include("modules/quanlysp/lietke.php");
} elseif ($tam == 'quanlysp' && $query == 'sua') {
    include("modules/quanlysp/sua.php");
} else {
    include("modules/dashboard.php");
}

?>
</div>
