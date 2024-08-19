<?php
// Kết nối tới cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "web_mysqli");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    // Nếu có lỗi, in ra thông báo lỗi và dừng chương trình
    die("Kết nối MySQL lỗi: " . $mysqli->connect_error);
}
?>
