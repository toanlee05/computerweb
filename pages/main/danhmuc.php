<?php
// Truy vấn để lấy các sản phẩm từ danh mục cụ thể
$sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$_GET[id]' ORDER BY id_sanpham DESC";
$query_pro = mysqli_query($mysqli, $sql_pro);

// Truy vấn để lấy thông tin danh mục cụ thể
$sql_cate = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$_GET[id]' LIMIT 1";
$query_cate = mysqli_query($mysqli, $sql_cate);

// Lấy thông tin danh mục
$row_title = mysqli_fetch_array($query_cate);
?>

<h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc']; ?></h3>
<ul class="product_list">
    <?php
    // Duyệt qua các kết quả của truy vấn và hiển thị các sản phẩm
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']; ?>">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" alt="<?php echo $row_pro['tensanpham']; ?>">
                <p class="title_product">Tên sản phẩm: <?php echo $row_pro['tensanpham']; ?></p>
                <p class="price_product">Giá: <?php echo number_format($row_pro['giasp'], 0, ',', '.'); ?> vnđ</p>
            </a>
        </li>
    <?php
    }
    ?>
</ul>
