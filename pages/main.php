<div id="main">
        <?php
            include("pages/sidebar/sidebar.php");
        ?>

</div>
            <div class="maincontent">
            <?php
           if(isset($_GET['quanly'])){
            $tam = $_GET['quanly'];
            }else{
                $tam='';  
            }
            if ($tam == 'danhmucsanpham') {
                include("main/danhmuc.php");
            } elseif ($tam == 'giohang') {
                include("main/giohang.php");
            } elseif ($tam == 'tintuc') {
                include("main/tintuc.php");
            } elseif ($tam == 'lienhe') {
                include("main/lienhe.php");
            } elseif ($tam == 'sanpham') {
                include("main/sanpham.php");
            } elseif ($tam == 'timkiem') {
                include("main/timkiem.php");
            } else {
                include("main/index.php");
            }
?>

            </div>       