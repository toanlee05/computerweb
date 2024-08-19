<?php
$sql_lietke_sp = "SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc 
FROM tbl_sanpham 
INNER JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
ORDER BY tbl_sanpham.id_sanpham DESC;";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
if ($query_lietke_sp === false) {
    die('Truy vấn gặp lỗi: ' . mysqli_error($mysqli));
}
?>
<p>Liệt kê sản phẩm</p>
<table style="width:100%;" border="1" style="border-collapse: collapse;">
<tr>
    <th>Id</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Giá sp</th>
    <th>Số lượng</th>
    <th>Danh mục</th>
    <th>Mã sp</th>
    <th>Tóm tắt</th>
    <th>Trạng thái</th>
    <th>Quản lý</th>

</tr>
<?php
$i = 0;
while ($row = mysqli_fetch_array($query_lietke_sp)) {
    $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['tensanpham']; ?></td>
        <td><img src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" width="150px"></td>
        <td><?php echo $row['giasp']; ?></td>
        <td><?php echo $row['soluong']; ?></td>
        <td><?php echo $row['tendanhmuc']; ?></td>
        <td><?php echo $row['masp']; ?></td>
        <td><?php echo $row['tomtat']; ?></td>
        <td><?php if ($row['tinhtrang'] == 1) {
                echo 'Kích hoạt';
            } else {
                echo 'Ẩn';
            }
            ?>
        </td>
        <td>
            <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>">Xoá</a> |<a href="
            ?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">Sửa</a>
        </td>
    </tr>
    <?php
}
?>
</table>
