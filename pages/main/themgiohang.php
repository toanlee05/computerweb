<?php
session_start();
include('../../admincp/config/config.php');

// Thêm số lượng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    $product = [];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // Nếu sản phẩm không phải là sản phẩm được tăng số lượng, giữ nguyên sản phẩm trong mảng
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
            $_SESSION['cart'] = $product;
        } else {
            // Tăng số lượng cho sản phẩm
            if($cart_item['soluong']<=9){
            $tangsoluong = $cart_item['soluong'] + 1;
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $tangsoluong,
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
            }else{
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $tangsoluong,
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location: ../../index.php?quanly=giohang');
}

//Trừ số lượng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    $product = [];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // Nếu sản phẩm không phải là sản phẩm được tăng số lượng, giữ nguyên sản phẩm trong mảng
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
            $_SESSION['cart'] = $product;
        } else {
            // giảm số lượng cho sản phẩm
            $tangsoluong = $cart_item['soluong'] - 1;
            if($cart_item['soluong']>1){
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $tangsoluong,
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
            }else{
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $tangsoluong,
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location: ../../index.php?quanly=giohang');
}

// Xóa sản phẩm
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $product = []; // Khởi tạo mảng trống để lưu trữ các sản phẩm còn lại sau khi xóa

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // Nếu không phải là sản phẩm cần xóa, thêm vào mảng $product
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        }
    }
    
    // Cập nhật lại session giỏ hàng sau khi đã xóa sản phẩm
    $_SESSION['cart'] = $product;
    
    // Chuyển hướng sau khi xóa sản phẩm
    header('Location: ../../index.php?quanly=giohang');
}

//xoa tat ca
if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
    unset($_SESSION['cart']);
    header('Location:../../index.php?quanly=giohang');
    }
// Thêm sản phẩm vào giỏ hàng
if (isset($_POST['themgiohang'])) {
        // session_destroy();
    $id = $_GET['idsanpham'];
    $soluong = 1;

    // Truy vấn để lấy thông tin sản phẩm
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '".$id."' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

    if ($row) {
        // Tạo mảng sản phẩm mới
        $new_product = array(array(
            'tensanpham' => $row['tensanpham'],
            'id' => $id,
            'soluong' => $soluong,
            'giasp' => $row['giasp'],
            'hinhanh' => $row['hinhanh'],
            'masp' => $row['masp']));

        // Kiểm tra session giỏ hàng tồn tại
        if(isset($_SESSION['cart'])){
            $found=false;
            $product = [];
            foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] == $id) {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $soluong+1,
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp']
                );
                $found = true;
            } else {
                // Nếu dữ liệu không trùng
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $cart_item['soluong'],
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp']
                );
            }
        }        

            if ($found==false) {
                // Thêm sản phẩm mới vào giỏ hàng nếu chưa tồn tại
                $_SESSION['cart'] = array_merge ($product,$new_product);
            } else {
                // Cập nhật giỏ hàng
                $_SESSION['cart'] = $product;
            }
        }else {
            // Nếu giỏ hàng chưa tồn tại, tạo mới giỏ hàng
            $_SESSION['cart'] = $new_product;
        }
}


header('Location: ../../index.php?quanly=giohang');
}

?>
